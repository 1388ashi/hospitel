<?php

namespace App\Http\Controllers\Admin;

use  Spatie\Activitylog\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class logActivityController extends Controller
{
    public function index() {
        $logActivitys = Activity::select('description','subject_type','event')->orderBy('id','desc')->paginate(50); 
        return view('admin.pages.log_activitys.index',compact('logActivitys'));
    }
}
