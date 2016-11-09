<?php

namespace App\Http\Controllers\User;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Pagination\LengthAwarePaginator as Pg;
use Carbon\Carbon;

use App\Http\Requests;

class UserController extends UserBaseController
{

    
    public function index()
    {
        $questions = $this->user->user()->questions()->orderBy('created_at','desc')->limit(5)->get();

        return view('user.dashboard',compact('questions'));
    }

    public function getQuestions(Request $request)
    {
//        dd($request->all());
        $total_questions = $this->user->user()->questions()->orderBy('created_at','desc')->paginate(2,['*'],'total_questions',isset($request->total_questions) ? $request->total_questions :1);

        $answers = Answer::where('user_id',$this->user->id())->lists('question_id');

        $not_answered_questions = Question::with(['users' => function($user){
             $user->where('user_id',$this->user->id())->withPivot('status');
        }])->whereNotIn('id',$answers)->orderBy('created_at','desc')->get();
//


        $not_answered_questions = $not_answered_questions->filter(function ($question, $key) {
            return count($question->users)>0;
        });

        $not_answered_questions = new Pg($not_answered_questions, count($not_answered_questions), 2 ,isset($request->not_answered_questions) ? $request->not_answered_questions :1,['path' => 'questions','pageName' => 'not_answered_questions']);


        $today_questions = Question::with(['users' => function($user){
            $user->where('user_id',$this->user->id())->where('user_question.created_at','like',date('Y-m-d') . '%')->withPivot('status');
        }])->orderBy('created_at','desc')->get();

        

        $today_questions = $today_questions->filter(function ($question, $key) {
            return count($question->users)>0;
        });

        $today_questions = new Pg($today_questions, count($today_questions), 2 ,isset($request->today_questions) ? $request->today_questions :1,['path' => 'questions','pageName' => 'today_questions']);
       

        return view('user.questions', compact('total_questions','not_answered_questions','today_questions'));
    }
}
