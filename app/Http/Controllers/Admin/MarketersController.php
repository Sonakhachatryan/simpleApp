<?php

namespace App\Http\Controllers\Admin;

use App\Models\Commission;
use App\Models\Marketer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session,Response;

class MarketersController extends AdminBaseController
{
  public function index()
  {
     $marketers  = Marketer::withTrashed()->paginate(2);
   
     return view('admin.marketers.index',compact('marketers'));
  }

  public function show($id)
  {
     $marketer = Marketer::withTrashed()->findOrFail($id);
     $marketer->commissions = $marketer->commissions()->orderBy('created_at', 'desc')->paginate(2);
  
     return view('admin.marketers.show',compact('marketer'));
  }

 public function pay(Request $request)
 {
     $commission = Commission::findOrFail($request->id);

     $commission->update(['payed' => $request->money,'payment_date' => Carbon::now()]);

     $marketer = Marketer::findOrFail($commission->marketer_id);
     $current_commissions = $marketer->current_commissions - $request->money;
     $marketer ->update(['current_commissions' => $current_commissions ]);
     Session::flash('success', 'Payed !');

     return back();
 }
    
    public function activate($id)
    {
        $marketer = Marketer::withTrashed()->findOrFail($id);
        $marketer->update(['deleted_at' => NULL]);
    }
    
    public function contract($id)
    {
        $marketer = Marketer::withTrashed()->findOrFail($id);
        $file="contract/marketerContracts/" . $marketer->contract ;
        return Response::download($file);
    }
}
 
 