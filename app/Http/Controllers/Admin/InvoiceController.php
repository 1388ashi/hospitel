<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorSurgery;
use App\Models\Invoice;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){
        $doctorId = request('doctor');
        $startDate = request('start_date');
        $endDate = request('end_date');
        $doctors = Doctor::select('id','name')->get();
        $invoices = Invoice::
            when($startDate && $endDate, function(Builder $query) use ($startDate, $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->when($doctorId, function (Builder $query) use ($doctorId) {
                return $query->where("doctor_id", $doctorId);
            })
            ->when($startDate, function (Builder $query) use ($startDate) {
                return $query->where("created_at", ">=", $startDate);
            })
            ->when($endDate, function (Builder $query) use ($endDate) {
                return $query->where("created_at", "<=", $endDate);
            })
            ->with('doctor')
        ->paginate(15);
        return view('admin.pages.invoices.index',compact('invoices','doctors'));
    }
    
    public function show($id){
        $invoice = Invoice::with('doctor')->findOrFail($id);
        return view('admin.pages.invoices.show',compact('invoice'));
    }

    public function update(Request $request,Invoice $invoice){
    
        $invoice->update([
            'description' => $request->description,
        ]);

        $data = [
            'status' => 'success',
            'message' => 'صورت حساب موفقیت به روزرسانی شد'
        ];
        return redirect()->route('admin.invoice.index')->with($data);
    }
    public function destroy(Request $request)
    {
        $id = $request->item_id;
        $invoice = Invoice::find($id);
        if ($invoice->status ==  1) {
            $data = [
                'status' => 'danger',
                'message' => 'صورت حساب پرداخت شده حذف نمیشود',
            ];
        }else{
            $invoice->delete();
            DoctorSurgery::where('invoice_id',$invoice->id)->update(['invoice_id' => null]);
            $data = [
            'status' => 'success',
            'message' => 'صورت حساب با موفقیت حذف شد',
            ];
        }
        return redirect()->back()->with($data);
    }
}
