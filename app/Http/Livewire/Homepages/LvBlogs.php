<?php

namespace App\Http\Livewire\Homepages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Converter;
use App\Models\{
    Blog,
};

class LvBlogs extends Component
{
    public $page = 1;
	public $limit_data = 0;
	public $total_page;

	public $search = '';
    
    public $input_search;

	protected $queryString = [
        'search' => ['except' => ''],
		'page' => ['except' => 1],
    ];

    public function mount()
    {
		$this->input_search = $this->search;
		$this->limit_data = 5;
    }

    public function render()
    {
        $main_query = Blog::select('blog.*')
        ->where('blog.is_publish', true)
		->when($this->search, function ($query, $search)
		{
			return $query->where('blog.title', 'like', '%'.$search.'%')
			->orWhere('blog.content', 'like', '%'.$search.'%');
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

        $query_blog = $main_query->when($offset, function ($query, $offset) use ($limit)
		{
			return $query->offset($offset);
		})
		->limit($limit)
		->orderBy('blog.created_at')->get();

        $data['blogs'] = $query_blog;

        return view('homepage.pages.blogs.lv_index')
        ->with($data)
        ->layout('homepage.user_layouts.lv_main');
    }
}
