<?php

namespace App\Http\Livewire\Partners\Courses\Lessons\Quizzes;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    LessonQuiz as Quiz,
    QuizAnswerKey as AnswerKey,
    QuizQuestion as Question,
    QuestionOption as Option,
};
class LvQuestion extends Component
{
    use WithFileUploads;
    
    protected $rules = [
        'title' => 'required_if:image,null|string',
        'image' => 'required_if:title,null|mimes:jpg,jpeg,png,gif|max:5120',
    ];

    public $style_options = ['-', 'A', 'B', 'C', 'D', 'E'];
    
    public $orders_id;
    
    public $notification = [
        'isOpen' => false, 
        'message' => "",
    ];
    
    public $isOpenOrder = false;
    
    public $answers = [
        [ 'title' => null, 'image' => null, 'type' => 'text', 'is_key' => false ],
        [ 'title' => null, 'image' => null, 'type' => 'text', 'is_key' => false ],
        [ 'title' => null, 'image' => null, 'type' => 'text', 'is_key' => false ],
        [ 'title' => null, 'image' => null, 'type' => 'text', 'is_key' => false ],
    ];

    public $temp_answers = [];
    public $temp_deleted_answers = [];

    public $answer_key;
    public $temp_answer_key;
    
    public $quiz;
    public $questions;
    public $question;
    public $iteration;
    
    public $title;
    public $image;
    public $temp_image;
    
    public function Mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->question = new Question;
    }

    public function hydrate()
    {
        $this->resetValidation();
    }
    
    public function render()
    {
        $this->questions = Question::where('quiz_id', $this->quiz->id)->orderBy('orders', 'asc')->get();
        return view('partners.course.lesson.quiz.question.live-index')
        ->with(['questions' => $this->questions])
        ->layout('partners.layouts.app-main');
    }

    public function addAnswer($mode = 'insert')
    {
        if($mode == 'insert') {
            if (count($this->answers) < 5) {
                $this->answers = Arr::add($this->answers, array_key_last($this->answers)+1, [ 'title' => null, 'image' => null, 'type' => 'text', 'is_key' => false ]);
            }
        }
        else if($mode == 'update') {
            if (count($this->temp_answers) < 5) {
                $this->temp_answers = Arr::add($this->temp_answers, array_key_last($this->temp_answers)+1, [ 'id' => null, 'title' => null, 'image' => null, 'temp_image' => null, 'type' => 'text', 'is_key' => false, 'is_deleted' => false ]);
            }
        }
    }

    public function deleteAnswer($id, $mode = 'insert')
    {
        if($mode == 'insert') {
            array_splice($this->answers, $id, 1);
        }
        else if($mode == 'update') {
            $this->temp_answers[$id]['is_deleted'] = true;
            if(is_null($this->temp_answers[$id]['temp_image'])) {
                $this->temp_answers[$id]['temp_image'] = false;
            }
            if($this->answer_key == $id) {
                $this->answer_key = null;
            }
        }
    }

    public function restoreAnswer($id)
    {
        if(is_null($this->temp_answers[$id]['image']) && $this->temp_answers[$id]['temp_image'] == false) {
            $this->temp_answers[$id]['temp_image'] = null;
        }
        if($this->answer_key == null) {
            $this->answer_key = $this->temp_answer_key;
        }
        $this->temp_answers[$id]['is_deleted'] = false;
    }

    public function store()
    {
        $this->validate([
            'answer_key' => 'required|integer',
            'title' => 'nullable|required_if:image,null|string',
            'image' => 'nullable|required_if:title,null|mimes:jpg,jpeg,png,gif|max:5120',
            'answers.*.title' => 'nullable|required_if:answers.*.image,null|string',
            'answers.*.image' => 'nullable|required_if:answers.*.title,null|mimes:jpg,jpeg,png,gif|max:5120',
        ]);
        if($this->answer_key <= count($this->answers)) {
            $this->answers[$this->answer_key]['is_key'] = true;

            $last_question = Question::where('quiz_id', $this->quiz->id)->orderBy('orders', 'desc')->first();

            $order = 1;
    
            if($last_question) {
                $order += $last_question->orders;
            }
            $filename = null;
            $path = null;
            if(!is_null($this->image)) {
                $filename = Date('YmdHis').'_image_question.'.$this->image->extension();
                $path = Storage::putFileAs('images/questions/lesson_'.$this->quiz->lesson_id.'/quiz_'.$this->quiz->id, $this->image, $filename);
            }
            $question = Question::create([
                'quiz_id' => $this->quiz->id,
                'uuid' => Str::uuid(),
                'title' => $this->title,
                'image' => $filename,
                'path' => $path,
                'orders' => $order,
            ]);

            foreach ($this->answers as $key => $value) {
                
                $opt_filename = null;
                $opt_path = null;
                if(!is_null($value['image'])) {
                    $opt_filename = Date('YmdHis').'_'.($key+1).'_image_question.'.$value['image']->extension();
                    $opt_path = Storage::putFileAs('images/questions/lesson_'.$this->quiz->lesson_id.'/quiz_'.$this->quiz->id.'/question_'.$question->id, $value['image'], $opt_filename);
                    $value['title'] = null;
                }

                $option = Option::create([
                    'question_id' => $question->id,
                    'uuid' => Str::uuid(),
                    'orders' => $key+1,
                    'title' => $value['title'],
                    'image' => $opt_filename,
                    'path' => $opt_path,
                    'type' => $value['type'],
                ]);
                if($value['is_key']) {
                    $answer = AnswerKey::create([
                        'quiz_id' => $this->quiz->id,
                        'question_id' => $question->id,
                        'option_id' => $option->id
                    ]);
                }
            }

        }
        
        $this->resetInput();
        $this->setNotif('Successfully adding data.');
    }

    public function update()
    {
        if(!is_null($this->image)) {
            $this->temp_image = false;
        }
        $this->validate([
            'answer_key' => 'required|integer',
            'title' => 'nullable|required_if:temp_image,null|string',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:5120',
            'temp_answers.*.title' => 'nullable|required_if:temp_answers.*.temp_image,null|string',
            'temp_answers.*.image' => 'nullable|mimes:jpg,jpeg,png,gif|max:5120',
        ]);
        // dd($this->answer_key != $this->temp_answer_key);
        if($this->answer_key <= count($this->temp_answers)) {
            if($this->temp_answer_key != $this->answer_key) {
                $this->temp_answers[$this->temp_answer_key]['is_key'] = false;
                $this->temp_answers[$this->answer_key]['is_key'] = true;
            }

            $filename = null;
            $path = null;
            if(!is_null($this->image)) {
                Storage::delete($this->question->path);
                $filename = Date('YmdHis').'_image_question.'.$this->image->extension();
                $path = Storage::putFileAs('images/questions/lesson_'.$this->quiz->lesson_id.'/quiz_'.$this->quiz->id, $this->image, $filename);
                $this->question->image = $filename;
                $this->question->path = $path;
            }

            $this->question->title = $this->title;
            $this->question->save();

            foreach ($this->temp_answers as $key => $value) {
                $opt_filename = null;
                $opt_path = null;
                $new_option = null;
                $old_option = null;
                if(!is_null($value['id'])) {
                    $old_option = Option::findOrFail($value['id']);
                }
                if(!is_null($value['image']) && $value['is_deleted'] == false) {
                    $opt_filename = Date('YmdHis').'_'.($key+1).'_image_question.'.$value['image']->extension();
                    $opt_path = Storage::putFileAs('images/questions/lesson_'.$this->quiz->lesson_id.'/quiz_'.$this->quiz->id.'/question_'.$this->question->id, $value['image'], $opt_filename);
                    $value['title'] = null;
                    if(!is_null($value['id'])) {
                        Storage::delete($old_option->path);
                        $old_option->image = $opt_filename;
                        $old_option->path = $opt_path;
                    }
                }

                if ($value['is_deleted'] == false) {
                    if(is_null($old_option)) {
                        $new_option = Option::create([
                            'question_id' => $question->id,
                            'uuid' => Str::uuid(),
                            'orders' => $key+1,
                            'title' => $value['title'],
                            'image' => $opt_filename,
                            'path' => $opt_path,
                            'type' => $value['type'],
                        ]);
                        $value['id'] = $new_option->id;
                    } else {
                        $old_option->title = $value['title'];
                        $old_option->type = $value['type'];
                        $old_option->save();
                    }
                } else {
                    if(!is_null($old_option)) {
                        Storage::delete($old_option->path);
                        $old_option->delete();
                    }
                }

                if($this->answer_key != $this->temp_answer_key && $value['is_key']) {
                    AnswerKey::where('id', $this->question->answerKey->id)->update(['option_id' => $value['id']]);
                }
            }

            $this->resetInput();
            $this->setNotif('Successfully updating data.');

        }
    }

    public function resetInput()
    {
        $this->reset(['title', 'image', 'answer_key', 'temp_image']);
        $this->question = new Question;
        $this->iteration++;
        $this->answers = [
            [ 'title' => null, 'image' => null, 'type' => 'text', 'is_key' => false ],
            [ 'title' => null, 'image' => null, 'type' => 'text', 'is_key' => false ],
            [ 'title' => null, 'image' => null, 'type' => 'text', 'is_key' => false ],
            [ 'title' => null, 'image' => null, 'type' => 'text', 'is_key' => false ],
        ];
    }

    public function setQuestion($id, $mode = 'standard')
    {
        $this->question = Question::find($id);
        if($mode == 'advanced') {
            $this->iteration++;
            $this->title = $this->question->title;
            $this->temp_image = $this->question->image;
            // $options = $this->question->options->map(function ($item, $key)
            // {
            //     $is_key = false;
            //     if ($this->question->answerKey->option_id == $item->id) {
            //         $is_key = true;
            //         $this->answer_key = $key;
            //         $this->temp_answer_key = $key;
            //     }
            //     return ['id' => $item->id, 'title' => $item->title, 'image' => null, 'temp_image' => $item->image, 'type' => $item->type, 'is_key' => $is_key];
            // });
            // $this->temp_answers = $options->toArray();
            $options = [];
            foreach ($this->question->options as $key => $item) {
                $is_key = false;
                if ($this->question->answerKey->option_id == $item->id) {
                    $is_key = true;
                    $this->answer_key = $key;
                    $this->temp_answer_key = $key;
                }
                $options[$key] = ['id' => $item->id, 'title' => $item->title, 'image' => null, 'temp_image' => $item->image, 'type' => $item->type, 'is_key' => $is_key, 'is_deleted' => false];
            }
            // dd($options);
            $this->temp_answers = $options;
        }
        // dd($id, $this->question);
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

    public function delete($id)
    {
        $question = Question::findOrFail($id);
        $get_option_path = 'images/questions/lesson_'.$this->quiz->lesson_id.'/quiz_'.$this->quiz->id.'/question_'.$question->id;

        // dd($get_option_path);
        Option::where('question_id', $question->id)->delete();
        Storage::delete($question->path);
        Storage::deleteDirectory($get_option_path);

        AnswerKey::where('question_id', $question->id)->delete();
        $question->delete();
        $this->resetInput();
        $this->setNotif('Successfully deleting data.');

    }

    public function openOrder($state = true)
    {
        $this->isOpenOrder = $state;
    }

    public function setType($index, $type, $mode = 'insert')
    {
        if($mode == 'insert') {
            $this->answers[$index]['type'] = $type;
        }
        else if($mode == 'update') {
            $this->temp_answers[$index]['type'] = $type;
        }
    }

    public function setTempImage($index)
    {
        $this->answers[$index]['temp_image'] = false;
    }
    
}
