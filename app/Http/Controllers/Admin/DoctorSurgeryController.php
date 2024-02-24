<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Doctor;
use App\Models\DoctorSurgery;
use App\Models\Invoice;
use App\Models\Surgery;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DoctorSurgeryController extends Controller
{
    public function show(Request $request){
        $doctors = Doctor::with('specialtie')->get();
        return view('Admin.pages.doctorSurgery.filter', ['doctors' => $doctors]);
    }
    public function index(Request $request){
        $doctorId = $request->input('doctor');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $doctor = Doctor::findOrFail($doctorId);

        $doctorSurgeries = DoctorSurgery::where('doctor_id', $doctorId)
        ->whereNull('invoice_id')
        ->when($startDate && $endDate, function(Builder $query) use ($startDate, $endDate) {
            $query->whereHas('surgery', function (Builder $query) use ($startDate, $endDate) {
                $query->whereBetween('released_at', [$startDate, $endDate]);
            });
        })
        ->with('doctor', 'surgery')
        ->get();
        return view('Admin.pages.doctorSurgery.index', ['doctorSurgeries' => $doctorSurgeries, 'doctor' => $doctor]);
    }
    
    public function store(InvoiceRequest $request){

        $doctorSurgery = DoctorSurgery::query()->whereIn('id',$request->input('doctorSurgery'));
        $amount = $doctorSurgery->sum('amount');

        $invoice = Invoice::create([
            'doctor_id' => $request->input('doctorId'),
            'amount' => $amount
        ]);

                $doctorSurgery->update([
                    'invoice_id' => $invoice->id
                ]);

        $data = [
            'status' => 'success',
            'message' => 'صورت حساب با موفقیت ایجاد شد',
        ];
        return redirect()->route('admin.invoice.index')->with($data);
    }
}
