<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\NotificationsController;
use App\Models\Answer;
use App\Models\Notifiable;
use App\Models\Question;
use App\Models\UserQuestion;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Video;
use Illuminate\Http\Request;
use Session;

use App\Http\Requests;

class AnswerController extends UserBaseController
{

    protected $paginate = 2;

    public function redirectIfAnswered($id)
    {
        if ($answer = Answer::withTrashed()->where(['user_id' => $this->user->id(), 'question_id' => $id])->first())
            return redirect("user/question/answer/$id/edit");

        return $this->getAnswer($id);
    }

    public function getAnswer($id)
    {
        $question = Question::findOrFail($id);

        return view('user.answer.index', compact('question'));
    }

    public function postAnswer($id, Request $request)
    {

//        $this->validate($request, [
//            'images.*' => 'image|max:20000',
//            'videos.*' => 'mimes:mp4|max:20000'
//        ]);

        $answer = $this->createAnswer($id, $request->all());

        if(count($request->images)>=1 && $request->images[0]!=NULL  && $this->user->user()->status == 'gold') {
            $data['images']  = $request->images;
            $data['removed']  = $request->removed_images;
            $this->addFile('images', $data, $answer->id);
        }

        if(count($request->videos)>=1 && $request->videos[0]!=NULL && $this->user->user()->status == 'gold') {
            $data['videos']  = $request->videos;
            $data['removed']  = $request->removed_videos;
            $this->addFile('videos', $data, $answer->id);
        }
        
        Session::flash('success', 'Answer added!');

        return redirect("/user/question/answer/$id/edit");
    }

    
    public function createAnswer($id, $request)
    {
        isset($request['content']) ? $content = $request['content'] : $content = NULL;
        isset($request['checkbox3']) ? $alias = 1 : $alias = 0;
        $answer = Answer::create([
            'content' => $content,
            'question_id' => $id,
            'user_id' => $this->user->id(),
            'alias' => $alias,
            'deleted_at' => Carbon::now(),
        ]);

        UserQuestion::where(['user_id' => $this->user->id(), 'question_id' => $id])->update(['status' => 'Not checked']);

        NotificationsController::answer_added(1, $this->user->id(), $id);

        return $answer;
    }

    public function getUpdateAnswer($id)
    {
        $question = Question::findOrFail($id);
        $answer = Answer::withTrashed()->with('images','videos')->where(['user_id' => $this->user->id(), 'question_id' => $id])->first();

        return view('user.answer.update', compact('question', 'answer'));
    }

    public function postUpdateAnswer($id, Request $request)
    {
        $answer = Answer::withTrashed()->where(['question_id' => $id, 'user_id' => $this->user->id()])->first();

        isset($request->content) ? $content = $request->content : $content = NULL;

        $answer->update(['content' => $content, 'deleted_at' => Carbon::now()]);

        if(count($request->images)>=1 && $request->images[0]!=NULL  && $this->user->user()->status == 'gold') {
            $data['images']  = $request->images;
            $data['removed']  = $request->removed_images;
            $this->addFile('images', $data, $answer->id);
        }

        if(count($request->videos)>=1 && $request->videos[0]!=NULL && $this->user->user()->status == 'gold') {
            $data['videos']  = $request->videos;
            $data['removed']  = $request->removed_videos;
            $this->addFile('videos', $data, $answer->id);
        }


        UserQuestion::where(['user_id' => $this->user->id(), 'question_id' => $id])->update(['status' => 'Not checked']);
        NotificationsController::answer_updated(1, $this->user->id(), $answer->question_id);

        Session::flash('success', 'Answer updated!');

        return back();
    }

    public function showAnswer($id)
    {
        $answer = Answer::withTrashed()->with('question','videos','images')->where(['user_id' => $this->user->id(), 'question_id' => $id])->first();

        return view('user.answer.show', compact('question', 'answer'));
    }

    public function delete($id, Request $request)
    {
        Answer::withTrashed()->where(['user_id' => $this->user->id(), 'question_id' => $id])->first()->forceDelete();
        UserQuestion::where(['user_id' => $this->user->id(), 'question_id' => $id])->update(['status' => "Deleted"]);
        Session::flash('success', 'Answer deleted!');

        return redirect('/user/questions');

    }

    public function getAlias($id, $alias)
    {
        $answer = Answer::withTrashed()->where(['user_id' => $this->user->id(), 'question_id' => $id])->first();

        $answer->update(['alias' => $alias]);

//        Session::flash('success', 'Name changed!');

//        return redirect('/user/questions');

    }

    public function hasAccessToQuestion($id, $model)
    {
        $item = $model::where(['user_id' => $this->user->id(), 'question_id' => $id])->first();

        return $item !== NULL;
    }

    public function answerDeleted($question_id)
    {
        return UserQuestion::where(['user_id' => $this->user->id(), 'question_id' => $question_id])->first()->status == 'DELETED';
    }

////jnjel
//    public function addImages($id, Request $request)
//    {
//        if($this->user->user()->status != 'gold')
//            return back()->with('error', 'You have no privilege.');
//        $this->validate($request, [
//            'images.*' => 'image'
//        ]);
//
//        $answer = Answer::withTrashed()->where(['question_id' => $id, 'user_id' => $this->user->id()])->first();
//
//        $created = false;
//        if (!$answer) {
//            $answer = $this->createAnswer($id, $request->all());
//            $created=true;
//        }
//
//
//        $this->addFile('images', $request->all(), $answer->id);
////        $this->addFile('images', $request->all(), $id);
//
//        if(!$created){
//            UserQuestion::where(['user_id' => $this->user->id(), 'question_id' => $id])->update(['status' => 'Not checked']);
//            NotificationsController::answer_updated(1, $this->user->id(), $answer->question_id);
//        }
//
//
//        Session::flash('success', 'Images added!');
//
//        return redirect("user/question/answer/$id/edit");
//    }
//
//    //jnjel
//    public function addVideos($id,Request $request)
//    {
//        if ($this->user->user()->status != 'gold')
//            return back()->with('error', 'You have no privilege.');
////        $this->validate($request,[
////            'videos.*' =>  ' mimes:video/x-flv,
////                             video/mp4,
////                             application/x-mpegURL,
////                             video/MP2T,
////                             video/3gpp,
////                             video/quicktime,
////                             video/x-msvideo,
////                             video/x-ms-wmv
////                              | max:30000000000'
////        ]);
////        dd($request->all());
//
//        $answer = Answer::withTrashed()->where(['question_id' => $id, 'user_id' => $this->user->id()])->first();
//
//        $created =false;
//        if (!$answer) {
//            $answer = $this->createAnswer($id, $request->all());
//            $created=true;
//        }
//
//        $this->addFile('videos', $request->all(), $answer->id);
//
//        if(!$created){
//            UserQuestion::where(['user_id' => $this->user->id(), 'question_id' => $id])->update(['status' => 'Not checked']);
//            NotificationsController::answer_updated(1, $this->user->id(), $answer->question_id);
//        }
//
//        Session::flash('success', 'Videos added!');
//
//        return redirect("user/question/answer/$id/edit");
//    }

    public function addFile($type, $request, $id)
    {
        $type == 'images' ? $destPath = 'images' : $destPath = 'videos';
        $removed = explode('?', $request['removed']);
        $i = 0;
        foreach ($request[$type] as $file) {
            if (!$this->isRemoved($file, $removed)) {
                $i++;
                $extension = $file->getClientOriginalExtension();
                $name = time() . "$i." . $extension;
                $file->move($destPath, $name);
                if ($type == 'images')
                    Image::create(['url' => $name, 'answer_id' => $id]);
                else {
                    Video::create(['url' => $name, 'answer_id' => $id]);
                }
            }
        }
    }

    public function isRemoved($uploading, $removed)
    {
        for ($i = 1; $i < count($removed); $i++) {
            if ($removed[$i] == $uploading->getClientOriginalName())
                return true;
        }
        return false;
    }

    public function removeImageFromAnswer($id, Request $request)
    {
        $image = Image::with(['answer' => function($answer){
            $answer->withTrashed();
        }])->findOrFail($id);
        $answer = $image->answer;

        if (file_exists('images/' . $image->url))
            unlink('images/' . $image->url);
        $image->delete();

        Session::flash('success', 'Image deleted!');
        UserQuestion::where(['user_id' => $this->user->id(), 'question_id' => $id])->update(['status' => 'Not checked']);
        NotificationsController::answer_updated(1, $this->user->id(), $answer->question_id);
        
        $rdrURL = 'user/question/answer/' . $answer->question_id . '/edit';

        return redirect($rdrURL);
    }


    public function removeVideoFromAnswer($id)
    {
        $video = Video::with(['answer' => function($answer){
            $answer->withTrashed();
        }])->findOrFail($id);
        $answer = $video->answer;

        if (file_exists('videos/' . $video->url))
            unlink('videos/' . $video->url);
        $video->delete();


        Session::flash('success', 'Video deleted!');

        $rdrURL = 'user/question/answer/' . $answer->question_id . '/edit';

        UserQuestion::where(['user_id' => $this->user->id(), 'question_id' => $id])->update(['status' => 'Not checked']);
        NotificationsController::answer_updated(1, $this->user->id(), $answer->question_id);
        
        return redirect($rdrURL);
    }
}
