<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\UserBaseController;
use App\Http\Requests;
use App\Models\Answer;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (auth('user')->check())
            new UserBaseController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('search.index', compact('tags'));
    }

    public function getByTagId($id)
    {
        $tag = Tag::with(['answers' => function ($answer) {
            $answer->with('question')->where('status','approved')->orderBy('created_at', 'desc');
        }])->find($id);

        $answers = $tag->answers()->paginate(1);

        return view('search.results', compact('answers','tag'));

    }
    
    public function getByName(Request $request)
    {
        if ($request->tag !== "") {
            $tag = Tag::where('name', $request->tag)->first();
            if($tag)
                return $this->getByTagId($tag->id);
        }

        $answers = Answer::orderBy('created_at','desc')->paginate(15);

        return view('search.results', compact('answers'));

    }
}
