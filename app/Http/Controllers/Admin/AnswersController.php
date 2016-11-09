<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\NotificationsController;
use App\Http\Requests;

use App\Models\Answer;
use App\Models\AnswerTag;
use App\Models\Notification;
use App\User;
use App\Models\Question;
use App\Models\UserQuestion;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class AnswersController extends AdminBaseController
{
    protected $paginate = 2;

    public function getShow($user_id, $question_id)
    {
        if($this->answerDeleted($user_id, $question_id))
            return view('admin.messages')->with('message','Answer Deleted');

        $question = Question::findOrFail($question_id);
        $answer = Answer::withTrashed()->with('videos','images')->where(['user_id' => $user_id, 'question_id' => $question_id])->first();

        return view('admin.answers.show', compact('question', 'answer'));
    }

    public function getEdit($id)
    {
        $answer = Answer::withTrashed()->with('question')->findOrFail($id);
        return view('admin.answers.edit', compact('answer'));
    }

    public function postEdit($id, Request $request)
    {
        $answer = $this->updateContent($id, $request->content);
        UserQuestion::where(['user_id' => $answer->user_id, 'question_id' => $answer->question_id])->first()->update(['status' => 'Not Approved']);
        Session::flash('success', 'Answer updated.');

        return back();
    }

    public function approve($id)
    {
        $answer = Answer::withTrashed()->with('question')->findOrFail($id);
        $answer->update(['deleted_at' => NULL]);
        UserQuestion::where(['user_id' => $answer->user_id, 'question_id' => $answer->question_id])->first()->update(['status' => 'Approved']);
        NotificationsController::answer_approved($answer->user_id, $answer->question_id);
        Session::flash('success', 'Answer approved.');

        return back();
    }

    public function updateContent($id, $content)
    {
        $answer = Answer::withTrashed()->with('question')->findOrFail($id);
        $answer->update(['content' => $content]);
        return $answer;
    }

    public function getTags($id)
    {
        $answer = Answer::withTrashed()->with('tags')->findOrFail($id);
        $tags = Tag::whereNotIn('id', $answer->tags->lists('id')->toArray())->get();
        $answer->tags = $answer->tags()->paginate($this->paginate);

        return view('admin.answers.tags', compact('answer', 'tags'));
    }

    public function addTagToAnswer($id, Request $request)
    {
        $this->validate($request,['tags' => 'required|min:1'],['tags.required' => 'At least one tag must be selected.']);

        foreach ($request->tags as $tag)
            AnswerTag::create(['answer_id' => $id, 'tag_id' => $tag]);
        session()->flash('success', 'Tag added.');

        return back();
    }

    public function deleteTagFromAnswer($answer_id,$tag_id,Request $request)
    {
        AnswerTag::where(['answer_id' => $answer_id,'tag_id'=>$tag_id ])->first()->delete();

        $rdrURL = "admin/answer/$answer_id/tags";
        if(isset($request->current_page)) {
            $current_page = $request->current_page;

            $count = Answer::withTrashed()->with('tags')->findOrFail($answer_id)->tags->count();
            $count = ceil($count / $this->paginate);
            if ($current_page > $count) {
                $current_page = $count;
            }

            $rdrURL .= '?page=' . $current_page;
        }

        session()->flash('success', 'Tag deleted.');

        return redirect($rdrURL);
    }

    public function answerDeleted($user_id, $question_id)
    {
        return UserQuestion::where(['user_id' => $user_id, 'question_id' =>$question_id ])->first()->status == 'Deleted';
    }
}

