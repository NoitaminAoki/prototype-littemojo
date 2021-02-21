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

    public $answer_key;
    
    public $quiz;
    public $questions;
    public $question;
    public $iteration;
    
    public $title;
    public $image;
    
    public function Mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->question = new Question;
    }
    
    public function render()
    {
        $this->questions = Question::where('quiz_id', $this->quiz->id)->orderBy('orders', 'asc')->get();
        return view('partners.course.lesson.quiz.question.live-index')
        ->with(['questions' => $this->questions])
        ->layout('partners.layouts.app-main');
    }

    public function addAnswer()
    {
        if (count($this->answers) < 5) {
            $this->answers = Arr::add($this->answers, array_key_last($this->answers)+1, [ 'title' => null, 'image' => null, 'type' => 'text', 'is_key' => false ]);
        }
    }

    public function deleteAnswer($id)
    {
        array_splice($this->answers, $id, 1);
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

    public function resetInput()
    {
        $this->reset(['title', 'answer_key']);
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
        if($mode = 'advanced') {
            $this->title = $this->question->title;
            $options = $this->question->options->map(function ($item, $key)
            {
                $is_key = false;
                if ($this->question->answerKey->option_id == $item->id) {
                    $is_key = true;
                    $this->answer_key = $key;
                }
                return ['title' => $item->title, 'image' => $item->image, 'type' => $item->type, 'is_key' => $is_key];
            });
            $this->answers = $options;
            // dd($options);
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

    public function openOrder($state = true)
    {
        $this->isOpenOrder = $state;
    }

    public function setType($index, $type)
    {
        $this->answers[$index]['type'] = $type;
    }
    
}
