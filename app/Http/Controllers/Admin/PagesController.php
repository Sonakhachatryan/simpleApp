<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Contact;
use App\Models\Home;
use App\Models\About;
use App\Models\Partner;
use Illuminate\Http\Request;
use Session;

class PagesController extends AdminBaseController
{
  
    public function home()
    {
        $records = Home::all();
        
        return view('admin.pages.home',compact('records'));
    }

    public function homeUpdate($id,Request $request)
    {
        $record = Home::findOrFail($id);

        $record -> update(['value' => $request->value]);

        Session::flash('success', 'Record updated!');

        return redirect('admin/homePage');
    }
    
    public function about()
    {
        $record = About::first();

        return view('admin.pages.about',compact('record'));
    }

    public function aboutUpdate($field,Request $request)
    {
        $record = About::first();

        $record -> update(["$field" => $request->value]);

        Session::flash('success', 'Record updated!');

        return redirect('admin/aboutPage');
    }

    public function partner()
    {
        $record = Partner::first();

        return view('admin.pages.partner',compact('record'));
    }


    public function partnerUpdate($field,Request $request)
    {
        $record = Partner::first();

        $record -> update(["$field" => $request->value]);

        Session::flash('success', 'Record updated!');

        return redirect('admin/partnerPage');
    }
}
