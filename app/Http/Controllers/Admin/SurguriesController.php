<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\surguries\SurguriesStoreRequest;
use App\Http\Requests\surguries\SurguriesUpdateRequest;
use App\Models\Doctor;
use App\Models\DoctorRole;
use App\Models\Insurance;
use App\Models\Operation;
use App\Models\Surgery;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class SurguriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view surguries')->only('index');
        $this->middleware('permission:create surguries')->only('create');
        $this->middleware('permission:create surguries')->only('store');
        $this->middleware('permission:edit surguries')->only('edit');
        $this->middleware('permission:edit surguries')->only('update');
        $this->middleware('permission:delete surguries')->only('destroty');
    }
    public function index()
    {
        $doctorId = request("doctor_id") !== "all" ? request("doctor_id") : null;
        $operationId = request("operation_id") !== "all" ? request("operation_id") : null;
        $patient_name = request("patient_name");
        $surguries = Surgery::select("id", "patient_name", "patient_national_code",'document_number','surgeried_at')
            ->when($patient_name, function (Builder $query) use ($patient_name) {
                return $query->where("patient_name", "like", "%{$patient_name}%");
            })
            ->when($doctorId, function (Builder $query) use ($doctorId) {
                return $query->where("doctor_id", $doctorId);
            })
            ->when($operationId, function (Builder $query) use ($operationId) {
                return $query->where("operation_id", $operationId);
            })
            ->paginate(15);
        $doctors = Doctor::select("id", "name");
        $operations = Operation::select("id", "name")->get();
        return view("admin.pages.surgery.index", compact(["operations", "doctors", "surguries"]));
    }
    public function create()
    {
        $operations = Operation::where('status',1)->get();
        $doctor_roles = DoctorRole::with('doctors')->get(); 
        $insurance_basic = Insurance::where('type','basic')->get(); 
        $insurance_supplementary = Insurance::where('type','supplementary')->get(); 
        return view('Admin.pages.surgery.create',compact('operations','doctor_roles','insurance_basic','insurance_supplementary'));
    }
    
    public function store(SurguriesStoreRequest $request){
        $description = strip_tags($request->description);
         
        $surgery =  Surgery::create([
            'patient_name' => $request->patient_name,
            'basic_insurance_id' => $request->insurance_basic,
            'supp_insurance_id' => $request->insurance_supplementary,
            'patient_national_code' => $request->patient_national_code,
            'document_number' => $request->document_number,
            'description' => $description,
            'surgeried_at' => $request->surgeried_at,
            'released_at' => $request->released_at,
        ]);
        
        $attachOperations = [];
        foreach ($request->input('operations') as $operationId) {
            $operation = Operation::find($operationId);
            $attachOperations[$operationId] = ['amount' => $operation->price];
        }
        $surgery->operations()->attach($attachOperations);

        $attachDoctors = [];
        foreach ($request->input('doctors') as $roleId => $doctorId) {
            if ($doctorId) {
                $doctorRole = DoctorRole::find($roleId);
                $amount = $surgery->getDoctorQuotaAmount($doctorRole);
                $attachDoctors[$doctorId] = ['doctor_role_id' => $roleId, 'amount' => $amount];
            }
        }
        $surgery->doctors()->attach($attachDoctors);
        
        
        $data = [
            'status' => 'success',
            'message' => 'جراحی با موفقیت ثبت شد',
        ];
        return redirect()->route('admin.surgeries.index')->with($data);
    }

    public function show($id){
        $surgery = Surgery::with('doctors','operations')->findOrFail($id);
        return view('admin.pages.surgery.show',compact('surgery'));
    }

    public function edit($id){
        $doctor_roles = DoctorRole::with('doctors')->get(); 
        $surgery = Surgery::with('operations','doctors')->findOrFail($id);
        $operations = Operation::all(); 
        $operationsEdit = $surgery->operations->pluck('id')->toArray();
        $insurance_basic = Insurance::where('type','basic')->get(); 
        $insurance_supplementary = Insurance::where('type','supplementary')->get(); 
        $doctors = $surgery->doctors()->pluck('doctors.id')->toArray();
        return view('admin.pages.surgery.edit',compact('operationsEdit','operations','surgery','doctor_roles','doctors','insurance_basic','insurance_supplementary'));
    }

    public function update(SurguriesUpdateRequest $request,Surgery $surgery){
        $doctor_roles = $request->input('doctors');
        
        $surgery->update([
            'patient_name' => $request->patient_name,
            'basic_insurance_id' => $request->insurance_basic ,
            'supp_insurance_id' => $request->insurance_supplementary,
            'patient_national_code' => $request->patient_national_code,
            'document_number' => $request->document_number,
            'surgeried_at' => $request->surgeried_at,
            'description' => $request->description,
            'released_at' => $request->released_at,
        ]);
        
        $syncDoctors = [];
        foreach ($request->input('doctors') as $roleId => $doctorId) {
            if ($doctorId) {
                $doctorRole = DoctorRole::find($roleId);
                $amount = $surgery->getDoctorQuotaAmount($doctorRole);
                $syncDoctors[$doctorId] = ['doctor_role_id' => $roleId, 'amount' => $amount];
            }
        }
        $surgery->doctors()->sync($syncDoctors);
        $surgery->attachOrSyncOperation($request->operations,true);
        
        $data = [
            'status' => 'success',
            'message' => 'جراحی با موفقیت به روزرسانی شد',
        ];
        return redirect()->route('admin.surgeries.index')->with($data);
    }
    public function destroy(Request $request)
    {
        $id = $request->item_id;
        Surgery::find($id)->delete();
        $data = [
        'status' => 'success',
        'message' => 'جراحی با موفقیت حذف شد',
        ];
        return redirect()->back()->with($data);
    }
}
