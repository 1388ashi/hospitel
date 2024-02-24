<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\insurance\InsuranceStoreRequest;
use App\Http\Requests\insurance\InsuranceUpdateRequest;
use App\Http\Requests\InsuranceRequest;
use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view insurances')->only('index');
        $this->middleware('permission:create insurances')->only('create');
        $this->middleware('permission:create insurances')->only('store');
        $this->middleware('permission:edit insurances')->only('edit');
        $this->middleware('permission:edit insurances')->only('update');
        $this->middleware('permission:delete insurances')->only('destroty');
    }
    public function index()
    {
        $insurances = Insurance::paginate();
        return view('Admin.pages.insurance.index',['insurances' => $insurances]);
    }
    
    public function create(){
        $insurances = Insurance::paginate();
        return view('Admin.pages.insurance.index',['insurances' => $insurances]);
    }
    public function store(InsuranceStoreRequest $request)
    {
        $isurances = new Insurance;
        $isurances->name = $request->name;
        $isurances->discount = $request->discount; 
        $isurances->type = $request->type; 
        $isurances->status = $request->status; 
        $isurances->save();

        $data = [
            'status' => 'success',
            'message' => 'بیمه با موفقیت ثبت شد'
        ];
        return redirect()->route('admin.insurances.index')->with($data);
    }
    public function update(InsuranceUpdateRequest $request, Insurance $insurance)
    {

        $insurance->update([
            'name' => $request->name,
            'type' => $request->type,
            'discount' => $request->discount,
            'status' => $request->status,
        ]);
            $data = [
                'status' => 'success',
                'message' => 'بیمه با موفقیت به روزرسانی شد'
            ];
        return redirect()->route('admin.insurances.index')->with($data);
    }
    public function destroy(Request $request)
    {
        $id = $request->item_id;
        Insurance::findOrFail($id)->delete();
        $data= [
            'status' => 'success',
            'message' => 'بیمه با موفقیت حذف شد',
        ];

        return redirect()->back()->with($data);
    }
}
