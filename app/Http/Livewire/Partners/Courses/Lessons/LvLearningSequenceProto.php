<?php

namespace App\Http\Livewire\Partners\Courses\Lessons;

use Livewire\Component;
use App\Models\{
    CourseLesson as Lesson,
    LessonBook as MsBook,
    LessonVideo as MsVideo,
    LessonQuiz as MsQuiz,
    LearningSequence as Sequence,
    ListSequence as ListSequence
};

class LvLearningSequenceProto extends Component
{
    public $notification = [
        'isOpen' => false, 
        'message' => "",
    ];

    public $lesson;

    public $books;
    public $videos;
    public $quizzes;

    public $sequences;
    public $title_sequences;

    public function Mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->refreshData();
        // dd($this->sequence_lists);
    }

    public function render()
    {
        return view('partners.course.lesson.learning_sequence.live-index-proto')
        ->layout('partners.layouts.app-main');
    }

    public function refreshData()
    {
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

        $this->sequences = Sequence::select('id', 'lesson_id', 'title')->where('lesson_id', $this->lesson->id)->get();
        $this->title_sequences = $this->sequences->toArray();
    }

    public function addSequence()
    {
        $sequence = Sequence::create([
            'lesson_id' => $this->lesson->id,
            'title' => 'Title',
        ]);
        $this->sequences->push($sequence);
        array_push($this->title_sequences, ['id' => $sequence->id, 'lesson_id' => $sequence->lesson_id, 'title' => $sequence->title]);
        $this->dispatchBrowserEvent('sortable:load');
        $this->setNotif('Successfully adding data.');
    }

    public function saveList($item)
    {
        $is_changed = false;
        foreach ($item as $key => $parent) {
            $sequence = $this->sequences[$key];
            $changed_title = $this->title_sequences[$key]['title'];
            if($sequence->id == $this->title_sequences[$key]['id'] && $sequence->title != $changed_title) {
                $sequence->title = $changed_title;
                $sequence->save();
                $is_changed = true;
            }
            foreach ($parent as $child_key => $child) {
                if(isset($child['list_id'])) {

                    $list = ListSequence::find($child['list_id']);
                    if($list->sequence_id <> $child['parent_id']) {

                        $list->sequence_id = $child['parent_id'];
                        $list->order = ($child_key+1);
                        $list->save();
                        $is_changed = true;

                    } else if($list->order <> ($child_key+1)) {
                        $list->order = ($child_key+1);
                        $list->save();
                        $is_changed = true;
                    }    
                } else {
                    $data_to_insert = [
                        'sequence_id' => $child['parent_id'],
                        'order' => ($child_key+1),
                    ];
                    $check_insert = null;
                    if($child['type'] == 'book') {
                        $data_to_insert['book_id'] = $child['id'];
                        $data_to_insert['type'] = 'book';
                        $check_insert = ListSequence::where('book_id', $child['id'])->first();
                    }
                    else if($child['type'] == 'video') {
                        $data_to_insert['video_id'] = $child['id'];
                        $data_to_insert['type'] = 'video';
                        $check_insert = ListSequence::where('video_id', $child['id'])->first();
                    }
                    else if($child['type'] == 'quiz') {
                        $data_to_insert['quiz_id'] = $child['id'];
                        $data_to_insert['type'] = 'quiz';
                        $check_insert = ListSequence::where('quiz_id', $child['id'])->first();
                    }
                    else {
                        continue;
                    }

                    if(is_null($check_insert)) {
                        ListSequence::create($data_to_insert);
                        $is_changed = true;
                    }
                }
            }
        }
        
        if($is_changed) {
            $this->refreshData();
            $this->setNotif('Successfully saving changes.');
        }
        else {
            $this->setNotif('No data has been changed.');
        }
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
