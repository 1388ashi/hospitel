<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialtiesRequest;
use App\Models\specialties;
use Illuminate\Http\Request;
use DB;

class SpecialtiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view role_doctors')->only('index');
    }
    public function index(){
        $specialties = specialties::all(); 
        return view('Admin.pages.specialties.index',compact('specialties'));
    }
    public function create(){
        $specialties = specialties::all(); 
        return view('Admin.pages.specialties.index',compact('specialties'));
    }
    public function store(SpecialtiesRequest $request)
    {
        $insert = DB::table('specialties')->insert(
            ['title' => $request->title,'status' => $request->status]
        );
        
        $data = [
            'status' => 'success',
            'message' => 'تخصص با موفقیت ثبت شد'
        ];
        return redirect()->route('admin.specialties')->with($data);
    }

    public function update(Specialties $specialtie,SpecialtiesRequest $request)
    {
        $specialtie->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);
        $data = [
            'status' => 'success',
            'message' => 'تخصص با موفقیت به روزرسانی شد'
        ];

        return redirect()->route('admin.specialties')->with($data);
    } 
    public function destroy(Request $request)
    {
        $id = $request->item_id;
        specialties::findOrFail($id)->delete();
        $data= [
            'status' => 'success',
            'message' => 'تخصص با موفقیت حذف شد',
        ];
    
        return redirect()->back()->with($data);
    }
}
