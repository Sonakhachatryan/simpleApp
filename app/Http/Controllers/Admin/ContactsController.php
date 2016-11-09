<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Contact;
use Illuminate\Http\Request;
use Session;

class ContactsController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $phones = Contact::where('role','phone')->get();
        $emails = Contact::where('role','email')->get();
        $address = Contact::where('role','address')->get();
        $contacts = Contact::whereIn('role',['Longitude','latitude','Facebook','Twitter','Pinterest','Google+','ContactEmail'])->get();

        return view('admin.contacts.index', compact('phones','emails','address','contacts'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($role,Request $request)
    {
        if($role != 'email')
           $this->validate($request,['value' => 'required']);
        else
            $this->validate($request,['value' =>'required|email']);
        
        Contact::create(['value' => $request->value,'role' => $role]);

        Session::flash('success', 'Contact added!');

        return redirect('admin/contacts');
    }

    public function update($id,Request $request)
    {
        $contact = Contact::findOrFail($id);
        
        if($contact->role != 'email')
            $this->validate($request,['value' => 'required']);
        else
            $this->validate($request,['value' =>'required|email']);

        $contact -> update(['value' => $request->value]);

        Session::flash('success', 'Contact updated!');

        return redirect('admin/contacts');
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
        Contact::destroy($id);

        Session::flash('success', 'Contact deleted!');

        return redirect('admin/contacts');

    }
}
