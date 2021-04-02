<?php

namespace App\Http\Livewire\Partners;

use Livewire\Component;
use App\Models\{
    Course,
    Catalog,
    CatalogTopic,
    Level
};

class LvCourseInsert extends Component
{
    protected $listeners = [
        'evSearchTopic' => 'searchTopic',
        'evSetTopic' => 'setTopic',
    ];
    public $suggested_topics = [];
    
    public $selected_catalog;

    public $topic_name;

    public function updatingTopicName($value)
    {
        $this->searchTopic($this->selected_catalog, $value);
    }
    
    public function render()
    {
        $catalogs = Catalog::all();
        $levels   = Level::all();
        return view('partners.course.live-create', compact('catalogs', 'levels'))
        ->layout('partners.layouts.app-main');
    }
    
    public function setTopic($topic_name)
    {
        $this->topic_name = $topic_name;
        $this->searchTopic(null, $topic_name);
    }

    public function searchTopic($catalog_id = null, $topic_name = null)
    {
        $query_search = CatalogTopic::select('*');
        if($catalog_id) {
            $this->selected_catalog = $catalog_id;
            $query_search->where('catalog_id', $this->selected_catalog);
        }
        if($topic_name) {
            $query_search->where('name', 'LIKE', "%$topic_name%");
        }
        $query_search->limit(20);
        $this->suggested_topics = $query_search->get();
    }
    
}
