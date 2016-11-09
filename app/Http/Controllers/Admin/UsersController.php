<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\NotificationsController;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Question;
use App\User;
use Illuminate\Http\Request;
use Session;

class UsersController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::withTrashed()->paginate(25);

        return view('admin.users.index', compact('users'));
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
        $user = User::withTrashed()->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }
    
    
    public function getQuestions($id)
    {
        $user  = User::withTrashed()->findOrFail($id);
        $user->questions = $user->questions()->paginate(3);
//        $questions = Question::whereNotIn('id',$user->questions()->lists('question_id'))->get();
//        dd($user);
        
        return view('admin.users.questions',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
//    public function create()
//    {
//        return view('admin.users.create');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
//    public function store(Request $request)
//    {
//
//        $requestData = $request->all();
//
//        User::create($requestData);
//
//        Session::flash('flash_message', 'User added!');
//
//        return redirect('users');
//    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
//    public function edit($id)
//    {
//        $user = User::findOrFail($id);
//
//        return view('users.edit', compact('user'));
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
//    public function update($id, Request $request)
//    {
//        
//        $requestData = $request->all();
//        
//        $user = User::findOrFail($id);
//        
//        $user->update($requestData);
//
//        Session::flash('success', 'User updated!');
//
//        return redirect('users');
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     *
//     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
//     */
//    public function destroy($id)
//    {
//        User::destroy($id);
//
//        Session::flash('flash_message', 'User deleted!');
//
//        return redirect('users');
//    }
//
//    public function activate($id)
//    {
//        $user = User::withTrashed()->findOrFail($id);
//        $user->update(['deleted_at' => NULL]);
//
//        NotificationsController::user_approved($user->id);
//
//        Session::flash('success', 'User approved!');
//
//        return back();
//
//    }
}
