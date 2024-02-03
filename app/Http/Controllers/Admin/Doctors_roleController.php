<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\roleDoctorsRequest;
use App\Models\DoctorRole;
use Illuminate\Http\Request;
use DB;

class Doctors_roleController extends Controller
{
public function __construct()
    {
        $this->middleware('permission:view users');

    }

    public function index(){
        $doctor_roles = DoctorRole::all(); 
        return view('Admin.pages.role-doctors.index',compact('doctor_roles'));
    }
    public function create(){
        $doctor_roles = DoctorRole::all(); 
        return view('Admin.pages.role-doctors.index',compact('doctor_roles'));
    }
    public function store(roleDoctorsRequest $request)
    {
        $insert = DB::table('doctor_roles')->insert(
            ['title' => $request->title,'status' => $request->status]
        );
        
        $data = [
            'status' => 'success',
            'message' => 'نقش دکتر با موفقیت ثبت شد '
        ];
        return redirect()->route('admin.roles-doctor')->with($data);
    }

    public function update($id,roleDoctorsRequest $request)
    {
        $doctor_roles = DoctorRole::findOrFail($id);
        $doctor_roles->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);
        $data = [
            'status' => 'success',
            'message' => 'نقش دکتر با موفقیت به روزرسانی شد'
        ];

        return redirect()->route('admin.roles-doctor')->with($data);
    } 
    public function destroy(Request $request)
    {
        $id = $request->item_id;
        DoctorRole::findOrFail($id)->delete();
        $data= [
            'status' => 'success',
            'message' => 'نقش دکتر با موفقیت حذف شد',
        ];
    
        return redirect()->back()->with($data);
    }
}
