<?php

namespace App\Http\Controllers\Admin;

use App\Events\DoctorRegistered;
use App\Http\Requests\doctors\DoctorStoreRequest;
use App\Http\Requests\doctors\DoctorUpdateRequest;
use App\Models\DoctorRole;
use App\Models\specialties;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view doctors')->only('index');
        $this->middleware('permission:create doctors')->only('create');
        $this->middleware('permission:create doctors')->only('store');
        $this->middleware('permission:edit doctors')->only('edit');
        $this->middleware('permission:edit doctors')->only('update');
        $this->middleware('permission:delete doctors')->only('destroty');
    }
    public function index()
    {
        $doctors = Doctor::with('specialtie:id,title')->paginate();
        return view('Admin.pages.doctors.index',['doctors' => $doctors]);
    }

    public function create()
    {
        $specialitys = specialties::all();
        $roles = DoctorRole::all();
        return view('admin.pages.doctors.create')->with([
            'roles' => $roles,
            'specialitys' => $specialitys
        ]);
    }
    public function store(DoctorStoreRequest $request)
    {
        $specialtie_id = specialties::find($request->speciality_id)->id;
        $doctor = Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'specialties_id' => $specialtie_id,
            'national_code' => $request->national_code,
            'medical_number' => $request->medical_number,
            'mobile' => $request->mobile,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);
        
        $doctor->attachOrSyncDoctorRoles($request->roles);
        
        // SendMail
        if ($doctor->email) {
            DoctorRegistered::dispatch($doctor);
        }
        $data = [
            'status' => 'success',
            'message' => 'دکتر با موفقیت ثبت شد',
        ];
        return redirect()->route('admin.doctors.index')->with($data);
    }

    public function edit($id)
    {
        $doctor = Doctor::with('doctorRoles')->findOrFail($id);
        $specialitys = specialties::all();  
        $roles = DoctorRole::all(); // لیست همه role ها
        $doctorRolesIds = $doctor->doctorRoles->pluck('id')->toArray();
        $data = [
            'doctor' => $doctor,
            'specialitys' => $specialitys,
            'roles' => $roles,
            'doctorRolesIds' => $doctorRolesIds,
        ];
        return view('admin.pages.doctors.edit')->with($data);
    }
    public function update($id,DoctorUpdateRequest $request)
    {
        $doctor = Doctor::findOrFail($id);
        if (filled($request->password)) {
            $password = $request->password;
        }else{
            $password = $doctor->password;
        }
        $roles = $request->input('roles');
        $doctor->attachOrSyncDoctorRoles($roles,true);

        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'specialties_id' => $request->speciality_id,
            'national_code' => $request->national_code,
            'medical_number' => $request->medical_number,
            'mobile' => $request->mobile,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);
        
        $data = [
                'status' => 'success',
                'message' => 'داده ها با موفقیت به روزرسانی شد'
            ];
            return redirect()->route('admin.doctors.index')->with($data);
    }

    public function destroy(Request $request)
    {
        $id = $request->item_id;
        Doctor::findOrFail($id)->delete();
        // $doctor->permissions()->delete();
        $data = [
        'status' => 'success',
        'message' => 'دکتر با موفقیت حذف شد',
        ];
        return redirect()->back()->with($data);
    }

}
