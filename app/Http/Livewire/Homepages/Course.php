<?php

namespace App\Http\Livewire\Homepages;

use Livewire\Component;
use Illuminate\Support\Arr;
use App\Helpers\Converter;
use App\Models\{
	Course as MdCourse,
	Level,
	Catalog,
	CatalogTopic
};

class Course extends Component
{
	public $skill_id, $cat_topic_id;

	public $title = '';
	public $catalog = '';
	public $level = '';
	public $duration = '';
	public $page = 1;
	public $limit_data = 0;
	public $total_page;
	
	protected $queryString = [
        'title' => ['except' => ''],
        'catalog' => ['except' => ''],
        'level' => ['except' => ''],
        'duration' => ['except' => ''],
		'page' => ['except' => 1],
    ];

	public $input_name;
	public $filter_data;
	public $level_name, $duration_name, $catalog_name, $topic_id;

	public function mount()
	{
		$this->filter_data = [];

		$this->input_name = $this->title;
		if($this->catalog) {
			$this->catalog_name = $this->catalog;
			$this->filter_data['ct.name'] = $this->catalog;
		}
		if($this->level) {
			$this->level_name = $this->level;
			$this->filter_data['lv.name'] = $this->level;
		}
		if($this->duration) {
			$this->duration_name = $this->duration;
			$this->filter_data['courses.duration'] = $this->duration;
		}
		
		$this->limit_data = 10;
	}

    public function render()
    {
		$main_query = MdCourse::select('courses.*', 'ct.name as catalog_name', 'lv.name as level_name','corp.name as corporation_name')
		->where([['courses.is_verified', true], ['courses.is_published', true]])
		->leftJoin('corporations as corp', 'corp.partner_id', 'courses.user_id')
		->leftJoin('catalogs as ct', 'ct.id', 'courses.catalog_id')
		->leftJoin('levels as lv', 'lv.id', 'courses.level_id')
		->when($this->title, function ($query, $title)
		{
			return $query->where('courses.title', 'like', '%'.$title.'%')
			->orWhere('corp.name', 'like', '%'.$title.'%')
			->orWhere('courses.description', 'like', '%'.$title.'%');
		})
		->when($this->filter_data, function ($query, $filter_data)
		{
			return $query->where($filter_data);
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
		

		$query_course = $main_query->when($offset, function ($query, $offset) use ($limit)
		{
			return $query->offset($offset);
		})
		->limit($limit)
		->orderBy('courses.created_at')->get();
		$data['courses'] = $query_course;
		// dd($data);
    	$data['levels']    = Level::select('id', 'name')->get();
    	$data['catalogs']    = Catalog::orderBy('name', 'asc')->get();
		$data['cat_topics'] = [];
        return view('livewire.homepages.course')
        ->with($data)
        ->layout('homepage.user_layouts.lv_main');
    }

	public function changeCatalog($name)
	{
		$this->catalog_name = $name;
		if(!$name) {
			$this->topic_id = "";
		}
		$topics = Catalog::select('ctp.id', 'ctp.name as text')
		->leftJoin('catalog_topics as ctp', 'ctp.catalog_id', 'catalogs.id')
		->where('catalogs.name', $name)
		->orderBy('ctp.name', 'asc')
		->get();
		return $this->dispatchBrowserEvent('select2:change', ['id' => '#topic_select2', 'data' => $topics, 'text_empty' => "Choose Catalog First"]);
	}

	public function filterCourse()
	{
		$filter = [];
		$this->catalog = "";
		$this->level = "";
		$this->duration = "";

		if($this->level_name) {
			$filter['lv.name'] = $this->level_name;
			$this->level = $this->level_name;
		}
		if($this->duration_name) {
			$filter['courses.duration'] = $this->duration_name;
			$this->duration = $this->duration_name;
		}
		if($this->catalog_name) {
			$filter['ct.name'] = $this->catalog_name;
			$this->catalog = $this->catalog_name;
		}
		if($this->topic_id) {
			$filter['courses.catalog_topic_id'] = $this->topic_id;
		}
		$this->filter_data = $filter;
		$this->page = 1;
	}

	public function searchCourse()
	{
		$this->title = $this->input_name;
		$this->page = 1;
	}

	public function goToPage($page)
	{
		if($page < 1) {
			$page = 1;
		}
		$this->page = $page;
	}
}
