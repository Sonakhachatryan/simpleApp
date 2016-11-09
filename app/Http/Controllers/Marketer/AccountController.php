<?php

namespace App\Http\Controllers\Marketer;

use Illuminate\Http\Request;
use Image, Hash;

use App\Http\Requests;

class AccountController extends MarketerBaseController
{

    protected $paginate = 2;

    public function index()
    {
        return view('marketer.account.index');
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:marketers,email,' . $this->marketer->id(),
            'avatar' => 'image'
        ]);

        $data = $request->except(['avatar','_token']);

        if(!is_null(request()->avatar))
        {
            $image = request()->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $data['avatar'] = time() . "." . $extension;
            $this->uploadFile($image,$data['avatar'],$this->marketer->user()->avatar);
        }
        
        $this->marketer->user()->update($data);
        session()->flash('success','Information updated.');
        return back();
    }

    public function getChangePassword()
    {
        return view('marketer.account.changePassword');
    }

    public function postChangePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, $this->marketer->user()->password)){
            session()->flash('old_password','Old password does not match.');
            return back();
        }

        $this->marketer->user()->update(['password' => bcrypt($request->password)]);

        session()->flash('success','Password changed.');

        return redirect('marketer/account-details');

    }

    public function uploadFile($image, $avatar, $old_image ="")
    {
        if ($old_image != ""  && $old_image != "user.png" ) {
            $file = 'images/marketers/' . $old_image;
            if(file_exists($file))
                unlink($file);
        }
        $destinationPath = 'images/marketers';
        Image::make($image->getRealPath())->resize(500, 500)->save($destinationPath . '/' . $avatar);
        return $avatar;
    }

    public function removeAvatar()
    {
        $avatar = $this->marketer->user()->avatar;

        if ($this->marketer->user()->avatar !=""  &&  $avatar != "user.png" ) {
            $file = 'images/marketers/' . $avatar;
            if(file_exists($file))
                unlink($file);
        }

        $this->marketer->user()->update(['avatar'=>'user.png']);
        session()->flash('success','Avatar removed.');

        return redirect('marketer/account-details');
    }




    public function delete(){
        $marketer = $this->marketer->user();
        $this->marketer->logout();
        $marketer->forceDelete();
        return redirect('/');
    }
}
