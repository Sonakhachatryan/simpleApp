<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\UserBaseController;
use App\Http\Controllers\Marketer\MarketerBaseController;
use App\Http\Requests;
use App\Models\Answer;
use App\Models\Home;
use App\User;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       if(auth('user')->check())
           new UserBaseController();

        if(auth('marketer')->check())
            new MarketerBaseController();


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = Home::where('role','Header1')->first();
        $content = Home::where('role','Content1')->first();
        $search = Home::where('role','Our Services Search')->first();
        $register = Home::where('role','Our Services Register Now')->first();
        $marketer1 = Home::where('role','Our Services Marketers part')->first();
        $about = Home::where('role','About US')->first();


        return view('home',compact('header','content','search','register','marketer1','about'));
    }
    
    public function showAnswer($id)
    {
        $answer = Answer::with('user','tags','question')->findOrFail($id);
        
        return view('showAnswer',compact('answer'));
    }

    public function showUser($id)
    {
        $user = User::with(['answers' => function($answer){
            $answer->with('question');
        }])->findOrFail($id);

        return view('showAnswer',compact('answer'));
    }

    public function getUser($id)
    {
        $searching_user = User::findOrFail($id);
        $searching_user->answers = $searching_user->answers()->with('question')->where('alias',0)->paginate(3);

        return view('user',compact('searching_user'));
    }



    public function aaa(Request $request)
    {
          $users = User::withTrashed()->paginate(2,['*'],'user_page',isset($request->user_page) ? $request->user_page :1);
          $questions = Question::paginate(2,['*'],'questions_page',isset($request->questions_page) ? $request->questions_page :1);
        
          return view('dpTest',compact('users','questions'));
    }
}
