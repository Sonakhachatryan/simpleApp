<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\NotificationsController;
use App\Http\Requests;

use App\Models\Answer;
use App\User;
use App\Models\Question;
use App\Models\UserQuestion;
use App\Models\Notifiable;  
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class QuestionsController extends AdminBaseController
{
    protected $paginate = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $questions = Question::paginate($this->paginate);


        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,['content' => 'required']);
        
        $requestData = $request->all();
//        $requestData['questionable_id'] = $this->admin->id();
//        $requestData['questionable_type'] = 'App\Models\Admin';

        Question::create($requestData);

        Session::flash('success', 'Question added!');

        return redirect('admin/questions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $question = Question::findOrFail($id);

        return view('admin.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $question = Question::findOrFail($id);
        $question->update($requestData);

        Session::flash('success', 'Question updated!');

        return redirect('admin/questions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id,Request $request)
    {
        Question::destroy($id);

        Session::flash('success', 'Question deleted!');

        $rdrURL = 'admin/questions';
        if(isset($request->current_page)) {
            $current_page = $request->current_page;

            $count = Question::all()->count();
            $count = ceil($count / $this->paginate);
            if ($current_page > $count) {
                $current_page = $count;
            }

            $rdrURL .= '?page=' . $current_page;
        }
        return redirect($rdrURL);
    }
    
    public function getShare($id)
    {

        $question = Question::findOrFail($id);

        $shared_users = UserQuestion::where('question_id',$id)->get();
        $users = UserQuestion::where('question_id',$id)->paginate($this->paginate);
     
        foreach($users as $key => $user) {
            $name = User::findOrFail($user->user_id)->name;
            $users[$key]->name = $name;
            $users[$key]->answer = Answer::withTrashed()->where(['question_id' => $id, 'user_id' => $user->id])->first();
        }
        
        $adding_users = User::whereNotIn( 'id', $shared_users->lists('user_id')->all())->get();
        
        return view('admin.questions.share', compact('question','users','adding_users'));
    }

    public function postShare($id, Request $request)
    {
//        dd($request->all());
        $this->validate($request,['users' =>'required'],['users.required' => 'Please choose at least one user.']);

        foreach ($request->users as $user) {
            UserQuestion::create([
                'user_id' => $user,
                'question_id' => $id,
                'status' => 'Not Answered',
            ]);
            NotificationsController::question_added_to__questionary($user,$id);
        }
        
        Session::flash('success', 'Question shared!');

        return back();
    }
    
    public function remove($id,Request $request)
    {
        $var = UserQuestion::findOrFail($id);
        Answer::where(['user_id' => $var->user_id,'question_id' => $var->question_id])->forceDelete();
        $notifications = Notifiable::where([
            'url' => 'user/question/' . $var->question_id. '/answer',
            'notifiable_id' => $var->user_id,
            'notifiable_type' => 'App\User',
        ])->delete();
        $var->delete();

        $rdrURL = 'admin/questions/' . $var->question_id . '/share';
        if(isset($request->current_page)) {
            $current_page = $request->current_page;
            $count = UserQuestion::where('question_id',$var->question_id)->count();

            $count = ceil($count / $this->paginate);

            if ($current_page > $count) {
                $current_page = $count;
            }

            $rdrURL .= '?page=' . $current_page;
        }
        return redirect($rdrURL);
    }


//    public function getTags($id)
//    {
//        $question = Question::findOrFail($id);
//
//        $shared_tags = QuestionTag::where('question_id',$id)->get();
//        $tags = QuestionTag::where('question_id',$id)->paginate($this->paginate);
//
//        foreach($tags as $key => $tag) {
//            $name = Tag::findOrFail($tag->tag_id)->name;
//            $tags[$key]->name = $name;
//        }
//
//        $adding_tags = Tag::whereNotIn( 'id', $shared_tags->lists('tag_id')->all())->get();
//
//        return view('admin.questions.tags', compact('question','tags','adding_tags'));
//    }
//
//    public function postTags($id, Request $request)
//    {
//        $this->validate($request,['tags' =>'required'],['tags.required' => 'Please choose at least one tag.']);
//
//        foreach ($request->tags as $tag) {
//            QuestionTag::create([
//                'tag_id' => $tag,
//                'question_id' => $id,
//            ]);
//        }
//        Session::flash('success', 'Tags added!');
//
//        return back();
//    }
//
//    public function removeTags($id,Request $request)
//    {
//        $var = QuestionTag::findOrFail($id);
//        $var->delete();
//
//        $rdrURL = 'admin/questions/' . $var->question_id . '/tags';
//        if(isset($request->current_page)) {
//            $current_page = $request->current_page;
//            $count = QuestionTag::where('question_id',$var->question_id)->count();
//
//            $count = ceil($count / $this->paginate);
//            if ($current_page > $count) {
//                $current_page = $count;
//            }
//
//            $rdrURL .= '?page=' . $current_page;
//        }
//        return redirect($rdrURL);
//    }
}
