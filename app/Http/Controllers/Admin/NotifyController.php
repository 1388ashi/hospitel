<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotifyController extends Controller
{

    public function index(){
        $notifications =  Notification::select('id','title','body','created_at','viewed_at')->latest('id')->get();
        return view('admin.pages.notifications.index',compact('notifications'));
    }
    
    public function show(Notification $notification){
        $notification->update([ 'viewed_at' => now() ]);
        return view('admin.pages.notifications.show',compact('notification'));
    }
}
