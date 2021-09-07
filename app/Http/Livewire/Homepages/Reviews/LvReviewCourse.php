<?php

namespace App\Http\Livewire\Homepages\Reviews;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Converter;
use App\Models\{
    Course,
    CustomerCourseRating as UserCourseRating,
};

class LvReviewCourse extends Component
{
    public $slug_course_name;
    public $course_id;

    public $star;
    public $review_filter;

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
        $this->review_filter = 'desc';

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

        $main_query = UserCourseRating::where('course_id', $course->id)
		->when($this->star != 'all', function ($query, $star) use ($review_star)
		{
			return $query->where('rating', $review_star);
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
        
        $query_review = $main_query->when($offset, function ($query, $offset) use ($limit)
		{
			return $query->offset($offset);
		})
		->limit($limit)
        ->orderBy('updated_at', $this->review_filter)->get();

        $this->course_id = $course->id;
        $data['course'] = $course;
        $data['courseReviews'] = $query_review;
        $data['courseDetailRating'] = $course->getDetailRating();
        // dd($data);
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
            $this->review_filter = 'desc';
        }
        else if ($filter == 'oldest') {
            $this->review_filter = 'asc';
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
