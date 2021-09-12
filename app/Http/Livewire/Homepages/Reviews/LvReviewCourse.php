<?php

namespace App\Http\Livewire\Homepages\Reviews;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Helpers\Converter;
use App\Models\{
    Course,
    CustomerCourseRating as UserCourseRating,
    UserHelpReview,
};

class LvReviewCourse extends Component
{
    public $slug_course_name;
    public $course_id;

    public $star;
    public $review_filter;
    public $review_text_filter;

	public $page = 1;
	public $limit_data = 0;
	public $total_page;

	protected $queryString = [
        'star' => ['except' => 'all'],
		'page' => ['except' => 1],
    ];
    
    public function mount($title)
    {
        $this->slug_course_name  = $title;
        if($this->star) {
            if($this->star >= 1 && $this->star <= 5) {
                $this->star = $this->star;
            } else {
                $this->star = 'all';
            }
        } else {
            $this->star = 'all';
        }
        
        $this->review_text_filter = 'Most Helpful';
        $this->review_filter = ['type' => 'number', 'value' => 'desc'];

		$this->limit_data = 5;
    }

    public function render()
    {
        $user_auth = Auth::guard('web')->user();
        $review_star = $this->star;
        
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)->firstOrFail();

        $main_query = UserCourseRating::select('customer_course_ratings.*')
        ->where('customer_course_ratings.course_id', $course->id)
		->when($this->star != 'all', function ($query, $star) use ($review_star)
		{
			return $query->where('customer_course_ratings.rating', $review_star);
		});


        $limit = $this->limit_data;
		$total_data = $main_query->count();
		$total_page = (int) ceil($total_data / $this->limit_data);
		if($total_page > 10) {
			$total_page = 10;
		}

		if ($this->page > $total_page) {
			$this->page = $total_page;
		}

		if($this->page <= 0) {
			$this->page = 1;
			$total_page = 1;
		}

		$this->total_page = $total_page;
		$offset = Converter::pageToOffset($this->page, $limit);
        
        $query_review = $main_query->when($user_auth, function ($query, $user_auth)
        {
            return $query->addSelect('user_hr.is_helpful')
            ->leftJoin('user_help_reviews as user_hr', function($join) use($user_auth)
            {
                $join->on('user_hr.review_id', '=', 'customer_course_ratings.id')
                ->where('user_hr.user_id', '=', $user_auth->id);
            });
        })
        ->when($this->review_filter['type'] == 'time', function ($query, $value)
        {
            return $query->orderBy('customer_course_ratings.updated_at', $this->review_filter['value']);
        })
        ->when($this->review_filter['type'] == 'number', function ($query, $value) use($user_auth)
        {
            $data_group = [
                'customer_course_ratings.id', 
                'customer_course_ratings.customer_id', 
                'customer_course_ratings.course_id', 
                'customer_course_ratings.rating', 
                'customer_course_ratings.description', 
                'customer_course_ratings.created_at', 
                'customer_course_ratings.updated_at',
            ];
            if($user_auth) {
                $data_group[] = 'user_hr.is_helpful';
            }
            return $query->selectRaw('SUM(IFNULL(help_r.is_helpful, 0)) as total_helpful')
            ->leftJoin('user_help_reviews as help_r', 'help_r.review_id', 'customer_course_ratings.id')
            ->groupBy($data_group)
            ->orderBy('total_helpful', $this->review_filter['value']);
        })
        ->orderBy('customer_course_ratings.id', 'asc')
        ->when($offset, function ($query, $offset) use ($limit)
		{
			return $query->offset($offset);
		})
		->limit($limit)
        ->get();

        $this->course_id = $course->id;
        $data['course'] = $course;
        $data['courseReviews'] = $query_review;
        $data['courseDetailRating'] = $course->getDetailRating();
        // dd($data['courseReviews']);
        return view('homepage.pages.reviews.lv_review_couse')
        ->with($data)
        ->layout('homepage.user_layouts.lv_main');
    }

    public function setReviewAll()
    {
        $this->star = 'all';
    }

    public function setReviewStar($star)
    {
        if($star >= 1 && $star <= 5) {
            $this->star = $star;
        } else {
            $this->star = 'all';
        }
    }

    public function setReviewFilter($filter)
    {
        if ($filter == 'latest') {
            $this->review_text_filter = 'Most Recent';
            $this->review_filter = ['type' => 'time', 'value' => 'desc'];
        }
        else if ($filter == 'oldest') {
            $this->review_text_filter = 'Oldest Reviews';
            $this->review_filter = ['type' => 'time', 'value' => 'asc'];
        }
        else if($filter == 'helpful') {
            $this->review_text_filter = 'Helpful Reviews';
            $this->review_filter = ['type' => 'number', 'value' => 'desc'];
        }
    }

    public function likeReview($review_id)
    {
        return $this->userHelp(true, $review_id);
    }

    public function dislikeReview($review_id)
    {
        return $this->userHelp(false, $review_id);
    }

    public function userHelp($is_helpful, $review_id)
    {
        $user_auth = Auth::guard('web')->user();

        if (!$user_auth) {
            return $this->dispatchBrowserEvent('notification:alert', ['title' => 'Need to Sign In!', 'message' => "Do you want to be redirected to the Sign In page?"]);
        }
        $data = [
            'is_helpful' => false,
            'vote' => 'no'
        ];
        if ($is_helpful) {
            $data['is_helpful'] = true;
            $data['vote'] = 'yes';
        }
        $help_review = UserHelpReview::firstOrCreate(
            ['user_id' => $user_auth->id, 'review_id' => $review_id],
            $data
        );
        if(!$help_review->wasRecentlyCreated) {
            if($help_review->is_helpful == $is_helpful) {
                $help_review->delete();
            } else {
                $help_review->is_helpful = $is_helpful;
                $help_review->vote = $data['vote'];
                $help_review->save();
            }
        }
    }

	public function goToPage($page)
	{
		if($page < 1) {
			$page = 1;
		}
		$this->page = $page;
	}
}
