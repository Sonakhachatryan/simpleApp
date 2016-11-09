<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Answer;
use Image, Hash;

use App\Http\Requests;

class AccountController extends UserBaseController
{

    protected $paginate = 2;

    public function index()
    {
        return view('user.account.index');
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'avatar' => 'image',
            'email' => 'required|email|unique:users,email,' . $this->user->id(),
        ]);

        $data = $request->except(['avatar','_token','alias']);
        if($request->alias == '') {
            $data['alias'] = NULL;
             Answer::withTrashed()->where('user_id',$this->user->id())->update(['alias' => 0]);
        }
        else{
            $data['alias'] = $request->alias;
        }

        if(!is_null(request()->avatar))
        {
            $image = request()->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $data['avatar'] = time() . "." . $extension;
            $this->uploadFile($image,$data['avatar'],$this->user->user()->avatar);
        }

        $this->user->user()->update($data);
        session()->flash('success','Information updated.');

        return back();
    }

    public function getChangePassword()
    {
        return view('user.account.changePassword');
    }

    public function postChangePassword(Request $request)
    {
        $this->validate($request,[
           'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, $this->user->user()->password)){
            session()->flash('old_password','Old password does not match.');
            return back();
        }

        $this->user->user()->update(['password' => bcrypt($request->password)]);

        session()->flash('success','Password changed.');

        return redirect('user/account-details');

    }

    public function uploadFile($image, $avatar, $old_image ="")
    {
        if ($old_image != ""  && $old_image != "user.png" ) {
            $file = 'images/users/' . $old_image;
            if(file_exists($file))
                unlink($file);
        }
        $destinationPath = 'images/users/';
        Image::make($image->getRealPath())->resize(500, 500)->save($destinationPath . '/' . $avatar);
        return $avatar;
    }

    public function removeAvatar()
    {
        $avatar = $this->user->user()->avatar;

        if ($this->user->user()->avatar !=""  &&  $avatar != "user.png" ) {
            $file = 'images/users/' . $avatar;
            if(file_exists($file))
                unlink($file);
        }

        $this->user->user()->update(['avatar'=>'user.png']);
        session()->flash('success','Avatar removed.');

        return redirect('user/account-details');
    }
    
    public function delete(){
    
        $user = $this->user->user();
        $this->user->logout();
        $user->forceDelete();
        return redirect('/');
    }
}
