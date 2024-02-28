<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ReportDoctorsController extends Controller
{
    public function show(Request $request){
        $doctors = Doctor::with('specialtie')->get();
        return view('Admin.pages.reports.filter', ['doctors' => $doctors]);
    }
    public function index(Request $request){
        $id = $request->input('doctor');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $doctor = Doctor::findOrFail($id);

        $reportsDoctors = Doctor::where('id', $id)
        // ->when($startDate && $endDate, function(Builder $query) use ($startDate, $endDate) {
        //     $query->whereHas('surgery', function (Builder $query) use ($startDate, $endDate) {
        //         $query->whereBetween('released_at', [$startDate, $endDate]);
        //     });
        // })
        ->with('invoices', 'payments','surgeries','doctorRoles')
        ->get();
        return view('Admin.pages.reports.index', ['reportsDoctors' => $reportsDoctors, 'doctor' => $doctor]);
    }
}
