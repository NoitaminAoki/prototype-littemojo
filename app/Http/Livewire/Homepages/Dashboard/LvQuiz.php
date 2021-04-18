<?php

namespace App\Http\Livewire\Homepages\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Course,
    CourseLesson,
    LessonQuiz,
    QuizQuestion,
    QuestionOption,
    CustomerAnswerKey as UserAnswer,
    CustomerQuizScore as UserScore,
};


class LvQuiz extends Component
{
    public $slug_course_name;
    public $lesson_id;
    public $quiz_id;
    public $quiz;
    public $user_score;
    
    public $question_id;
    
    public $selected_option_value;
    public $type_action;
    public $selected_question;
    
    public $finish_quiz = false;
    public $is_quiz_completed = false;
    
    public function mount($title, $lesson_id, $quiz_id)
    {
        $user_auth = Auth::guard('web')->user();

        $this->slug_course_name  = $title;
        $this->lesson_id  = $lesson_id;
        $this->quiz_id  = $quiz_id;
        
        $quiz = LessonQuiz::where([['lesson_id', $lesson_id], ['id', $quiz_id]])->firstOrFail();
        $user_score = UserScore::where([['quiz_id', $quiz->id], ['customer_id', $user_auth->id]])->first();
        if($user_score) {
            $this->is_quiz_completed = true;
            $this->quiz = $quiz;
            $this->user_score = $user_score;
        } else {
            $this->selected_question = QuizQuestion::where('quiz_id', $quiz->id)->firstOrFail();
            $this->question_id = $this->selected_question->id;
        }
    }
    
    public function updatingSelectedOptionValue($value)
    {
        $this->type_action = 'form';
    }
    
    public function render()
    {
        $user_auth = Auth::guard('web')->user();
        
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)->firstOrFail();
        
        if($this->is_quiz_completed) {
            if(gettype($this->quiz) != 'object' || gettype($this->user_score) != 'object') {
                $quiz = LessonQuiz::where([['lesson_id', $this->lesson_id], ['id', $this->quiz_id]])->first();
                $user_score = UserScore::where([['quiz_id', $quiz->id], ['customer_id', $user_auth->id]])->first();
                $this->quiz = $quiz;
                $this->user_score = $user_score;
            }
            $question_answers = QuizQuestion::select('quiz_questions.*', 'user_answer.option_id as user_option_id', \DB::raw('IF(user_answer.option_id = a_key.option_id, true, false) as is_correct'))
            ->where([['user_answer.customer_id', $user_auth->id], ['user_answer.quiz_id', $this->quiz_id]])
            ->leftJoin('customer_answer_keys as user_answer', 'user_answer.question_id', 'quiz_questions.id')
            ->leftJoin('quiz_answer_keys as a_key', 'a_key.question_id', 'quiz_questions.id')
            ->get();

            $data['question_answers'] = $question_answers;
        } else {
            $user_answer = UserAnswer::select('customer_answer_keys.*', 'quest.orders')
            ->where([['customer_answer_keys.customer_id', $user_auth->id], ['customer_answer_keys.quiz_id', $this->quiz_id]])
            ->leftJoin('quiz_questions as quest', 'quest.id', 'customer_answer_keys.question_id')
            ->get();
            
            if($user_answer->isNotEmpty()) {
                $get_answer_question = $user_answer->where('question_id', $this->question_id)->first();
                if($get_answer_question) {
                    $this->selected_option_value = $get_answer_question->option_id;
                }
            }
            // $this->type_action = 'normal';
            $data['user_answer'] = $user_answer;
            
            if(gettype($this->selected_question) != 'object') {
                $this->selected_question = QuizQuestion::where([['quiz_id', $this->quiz_id], ['id', $this->question_id]])->firstOrFail();
            }
        }
        
        $data['course'] = $course;
        return view('homepage.pages.courses.enrolled.lv_quiz')
        ->with($data)
        ->layout('homepage.dashboard_layouts.lv_main');
    }
    
    public function setQuestion($order)
    {
        $user_auth = Auth::guard('web')->user();
        
        $question = QuizQuestion::where([['quiz_id', $this->quiz_id], ['orders', $order]])->firstOrFail();
        $this->question_id = $question->id;
        
        $option = QuestionOption::where([['question_id', $this->selected_question->id], ['id', $this->selected_option_value]])->first();
        if($option) {
            $user_answer = UserAnswer::updateOrCreate(
                ['customer_id' => $user_auth->id, 'quiz_id' => $this->quiz_id, 'question_id' => $this->selected_question->id],
                ['option_id' => $option->id],
            );
        }
        $this->selected_question = $question;
    }
    
    public function setFinish()
    {
        $user_auth = Auth::guard('web')->user();
        $option = QuestionOption::where([['question_id', $this->selected_question->id], ['id', $this->selected_option_value]])->first();
        if($option) {
            $user_answer = UserAnswer::updateOrCreate(
                ['customer_id' => $user_auth->id, 'quiz_id' => $this->quiz_id, 'question_id' => $this->selected_question->id],
                ['option_id' => $option->id],
            );
        }
        
        $check_answer = UserAnswer::where([['customer_id', $user_auth->id], ['quiz_id', $this->quiz_id]])->count();
        $total_quiz = QuizQuestion::where('quiz_id', $this->quiz_id)->count();
        if($check_answer !== $total_quiz) {
            return $this->dispatchBrowserEvent('notification:alert', ['message' => "You must answer all questions!"]);
        }
        $this->finish_quiz = true;
        return $this->dispatchBrowserEvent('notification:dialog_finish', ['message' => "Are you sure want to finish the quiz?"]);
    }
    
    public function finishQuiz()
    {
        $user_auth = Auth::guard('web')->user();
        $total_quiz = QuizQuestion::where('quiz_id', $this->quiz_id)->count();
        $check_answer = UserAnswer::select(\DB::raw('IF(customer_answer_keys.option_id = a_key.option_id, true, false) as is_correct'))
        ->where([['customer_answer_keys.customer_id', $user_auth->id], ['customer_answer_keys.quiz_id', $this->quiz_id]])
        ->leftJoin('quiz_answer_keys as a_key', 'a_key.question_id', 'customer_answer_keys.question_id')
        ->get();
        
        $correct_answer = 0;
        $wrong_answer = 0;
        
        $score = 0;
        
        foreach ($check_answer as $key => $value) {
            if($value->is_correct == 1) {
                $correct_answer += 1;
            } else {
                $wrong_answer += 1;
            }
        }
        
        $score = $correct_answer/$total_quiz * 100;
        
        $user_final_score = UserScore::create(
            ['customer_id' => $user_auth->id, 'quiz_id' => $this->quiz_id, 'score' => $score, 'right_answer' => $correct_answer, 'wrong_answer' => $wrong_answer]
        );
        $this->is_quiz_completed = true;
    }
}
