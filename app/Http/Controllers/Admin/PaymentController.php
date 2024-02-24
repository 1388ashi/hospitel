<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\paymentStoreRequest;
use App\Http\Requests\Payment\paymentUpdateRequest;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index(){
        // $doctorId = request('doctor');
        // $startDate = request('start_date');
        // $endDate = request('end_date');
        $doctors = Doctor::select('id','name')->get();

        // $payments = Payment::
        //     when($startDate && $endDate, function(Builder $query) use ($startDate, $endDate) {
        //             $query->whereBetween('created_at', [$startDate, $endDate]);
        //     })
        //     ->when($doctorId, function (Builder $query) use ($doctorId) {
        //         return $query->where("doctor_id", $doctorId);
        //     })
        //     ->when($startDate, function (Builder $query) use ($startDate) {
        //         return $query->where("created_at", ">=", $startDate);
        //     })
        //     ->when($endDate, function (Builder $query) use ($endDate) {
        //         return $query->where("created_at", "<=", $endDate);
        //     })
        //     ->with('doctor')
        // ->paginate(15);
        $payments = Payment::with('invoice.doctor:id,name,mobile')
        ->when($doctors, function ($query) use ($doctors) {
            return $query->whereHas('invoice.doctor', function ($query) use ($doctors) {
                $query->where('name', 'like', '%'.$doctors.'%');
            });
        })
        ->latest('id')
        ->paginate();

        return view('admin.pages.payments.index', compact('payments','doctors'));
    }
    public function store(paymentStoreRequest $request){
        $inputs = [
            'invoice_id' => $request->invoice_id,
            'amount' => $request->amount,
            'pay_type' => $request->pay_type,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 1,
        ];
        if($request->hasFile('recipt') && $request->file('recipt')->isValid()){
            $inputs['recipt'] = $request->file('recipt')->store('images/payments','public');
        }
        Payment::query()->create($inputs);
        $invoice = Invoice::query()->findOrFail($request->invoice_id);
        if($invoice->getSumPaymentAmount() == $invoice->amount){
            $invoice->update(['status' => 1]);
        }
        $data = [
            'status' => 'success',
            'message' => 'پرداخت موفقیت ثبت شد'
        ];
        return redirect()->route('admin.payments.index')->with($data);
    }
    public function update(paymentUpdateRequest $request,Payment $payment){
        $inputs = [
            'invoice_id' => $request->invoice_id,
            'amount' => $request->amount,
            'pay_type' => $request->pay_type,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ];
        if($request->hasFile('recipt') && $request->file('recipt')->isValid()){
            $inputs['recipt'] = $request->file('recipt')->store('images/payments','public');
            Storage::disk('public')->delete($payment->image);
        }
        Payment::query()->update($inputs);

        $invoice = Invoice::query()->findOrFail($request->invoice_id);

        if($invoice->getSumPaymentAmount() == $invoice->amount){
            $invoice->update(['status' => 1]);
        }else{
            $invoice->update(['status' => 0]);
        }
        
        if($request->status == 0){
            $invoice->update(['status' => 1]);
        }else{
            $invoice->update(['status' => 0]);
        }

        $data = [
            'status' => 'success',
            'message' => 'پرداخت موفقیت به روزرسانی شد'
        ];
        return redirect()->back()->with($data);
    }
}
