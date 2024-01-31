<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
      public function showLoginForm()
      {
            return view("login.login");
      }
      public function login(Request $request)
      {
            $credentials = $request->validate([
                  'mobile' => ['required', 'digits:11'],
                  'password' => ['required', 'min:3'],
            ]);
            $mobile = $request->mobile;
            $password = $request->password;
            

      $user = User::where('mobile',$mobile)->first();
      if(Auth::attempt($credentials)){
            if (Hash::check($password,$user->password)){
            session()->put('user_id',$user->id);
            session()->put('user_title',$user->name);
            return redirect()->route('admin.dashboard');
            } else {
            $status = 'danger';
            $message = 'اطلاعات وارد شده اشتباه است';
            return redirect()->back()->with(['status' => $status,'message' => $message]);
            }
      }else{
      $status = 'danger';
      $message = 'اطلاعات وارد شده اشتباه است';
      $data = [
            'status' => $status,
            'message' => $message
            ];
      return redirect()->back()->with($data);
      }
      }
      public function logout(){
            Auth::logout();
            return redirect('/login');
      }
}
