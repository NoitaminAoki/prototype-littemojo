<?php

namespace App\Http\Livewire\Partners\Courses\Lessons;

use Livewire\Component;
use App\Models\{
    CourseLesson as Lesson,
    LessonBook as MsBook,
    LessonVideo as MsVideo,
    LessonQuiz as MsQuiz,
    LearningSequence as Sequence
};

class LvLearningSequence extends Component
{
    public $notification = [
        'isOpen' => false, 
        'message' => "",
    ];
    
    public $is_changed = false;

    public $lesson;

    public $books;
    public $videos;
    public $quizzes;

    public $sequences;
    public $sequence_lists;

    public function Mount(Lesson $lesson)
    {
        $this->lesson = $lesson;

        $this->books = MsBook::select('lesson_books.*')
        ->selectRaw('IF(list_sequences.id IS NULL, 0, 1) as is_listed')
        ->leftJoin('list_sequences', 'lesson_books.id', '=', 'list_sequences.book_id')
        ->where('lesson_id', $this->lesson->id)
        ->havingRaw('is_listed = 0')
        ->orderBy('orders', 'asc')->get();

        $this->videos = MsVideo::select('lesson_videos.*')
        ->selectRaw('IF(list_sequences.id IS NULL, 0, 1) as is_listed')
        ->leftJoin('list_sequences', 'lesson_videos.id', '=', 'list_sequences.video_id')
        ->where('lesson_id', $this->lesson->id)
        ->havingRaw('is_listed = 0')
        ->orderBy('orders', 'asc')->get();

        $this->quizzes = MsQuiz::select('lesson_quizzes.*')
        ->selectRaw('IF(list_sequences.id IS NULL, 0, 1) as is_listed')
        ->leftJoin('list_sequences', 'lesson_quizzes.id', '=', 'list_sequences.quiz_id')
        ->where('lesson_id', $this->lesson->id)
        ->havingRaw('is_listed = 0')
        ->orderBy('orders', 'asc')->get();

        $this->sequences = Sequence::where('lesson_id', $this->lesson->id)->get();
        $this->sequence_lists = $this->sequences->mapWithKeys(function($item) {
            return [$item->id => $item->items()];
        });
        // dd($this->sequence_lists);
    }

    public function render()
    {
        return view('partners.course.lesson.learning_sequence.live-index')
        ->layout('partners.layouts.app-main');
    }

    public function addSequence()
    {
        $sequence = Sequence::create([
            'lesson_id' => $this->lesson->id,
            'title' => 'Title',
        ]);
        $this->sequences->push($sequence);
        $this->sequence_lists[$sequence->id] = [];
        // $this->sequence_lists = $this->sequence_lists->union([$sequence->id => []]);
        $this->setNotif('Successfully adding data.');
    }

    public function switchList($item)
    {
        $this->is_changed = true;
        $obj_item = (object) $item;
        $temp_list = $this->sequence_lists[$obj_item->parent_id];
        array_splice($temp_list, $obj_item->index, 0, [['unique_id' => $obj_item->unique_id, 'id' => (integer) $obj_item->id, 'title' => $obj_item->title, 'type' => $obj_item->type]]);
        $this->sequence_lists[$obj_item->parent_id] = $temp_list;

        $temp_sender_list = collect($this->sequence_lists[$obj_item->sender_id]);
        $item_key = $temp_sender_list->where('unique_id', $obj_item->unique_id)->keys()[0];
        
        $temp_sender_list->forget($item_key);
        $this->sequence_lists[$obj_item->sender_id] = $temp_sender_list;
    }

    public function addItemToList($item)
    {
        $this->is_changed = true;
        $obj_item = (object) $item;
        if($obj_item->type == 'book') {
            $books = $this->books->where('id', $obj_item->id);
            if($books->keys()->isNotEmpty()) {
                $temp_list = $this->sequence_lists[$obj_item->parent_id];
                array_splice($temp_list, $obj_item->index, 0, [['unique_id' => "{$obj_item->type}_{$obj_item->id}", 'id' => (integer) $obj_item->id, 'title' => $books->first()->title, 'type' => 'book']]);
                $this->sequence_lists[$obj_item->parent_id] = $temp_list;
                // $this->sequence_lists[$obj_item->parent_id] = collect($this->sequence_lists[$obj_item->parent_id])->push(['id' => (integer) $obj_item->id, 'title' => $books->first()->title, 'type' => 'book']);
                // $this->sequence_lists[$obj_item->parent_id] = collect($this->sequence_lists[$obj_item->parent_id])->splice($obj_item->index + 1, 0, ['id' => (integer) $obj_item->id, 'title' => $books->first()->title, 'type' => 'book']);
                // dd($obj_item->index + 1);
                // dd($this->sequence_lists[$obj_item->parent_id]);
                $this->books->forget($books->keys()[0]);
            }
        } 
        else if($obj_item->type == 'video') {
            $videos = $this->videos->where('id', $obj_item->id);
            if($videos->keys()->isNotEmpty()) {
                $temp_list = $this->sequence_lists[$obj_item->parent_id];
                array_splice($temp_list, $obj_item->index, 0, [['unique_id' => "{$obj_item->type}_{$obj_item->id}", 'id' => (integer) $obj_item->id, 'title' => $videos->first()->title, 'type' => 'video']]);
                $this->sequence_lists[$obj_item->parent_id] = $temp_list;
                $this->videos->forget($videos->keys()[0]);
            }
        }
        else if($obj_item->type == 'quiz') {
            $quizzes = $this->quizzes->where('id', $obj_item->id);
            if($quizzes->keys()->isNotEmpty()) {
                $temp_list = $this->sequence_lists[$obj_item->parent_id];
                array_splice($temp_list, $obj_item->index, 0, [['unique_id' => "{$obj_item->type}_{$obj_item->id}", 'id' => (integer) $obj_item->id, 'title' => $quizzes->first()->title, 'type' => 'quiz']]);
                $this->sequence_lists[$obj_item->parent_id] = $temp_list;
                $this->quizzes->forget($quizzes->keys()[0]);
            }
        }
        
        // $parent_list->push(['id' => $obj_item->id]);
        // dd($this->sequence_lists->get($obj_item->parent_id));
        // dd();
    }

    public function setNotif($message)
    {
        $this->notification = [
            'isOpen' => true,
            'message' => $message
        ];
    }

    public function resetNotif()
    {
        $this->notification = [
        'isOpen' => false,
        'message' => ""
        ];
    }
}
