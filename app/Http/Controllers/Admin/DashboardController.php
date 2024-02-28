<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Invoice;
use  Spatie\Activitylog\Models\Activity;
use App\Models\Payment;

class DashboardController extends Controller
{
    function index(){
        // $paymentToday = Payment::where();
        $invoices = Invoice::where('status',0);
        $doctors = Doctor::where('status',1);
        $logActivity =  Activity::select('description','subject_type','event')->latest('id',10);
        
        return view('admin.pages.dashboard',compact(
            // 'paymentToday'
            'logActivity'
            ,'doctors'
            ,'invoices'));
        }
}
