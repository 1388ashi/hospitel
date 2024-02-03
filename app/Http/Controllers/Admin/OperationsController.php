<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperationsRequest;
use App\Models\Operation;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    public function index(){
        $operations = Operation::all(); 
        return view('Admin.pages.operations.index',compact('operations'));
    }
    public function create(){
        $operations = Operation::all(); 
        return view('Admin.pages.operations.index',compact('operations'));
    }
    public function store(OperationsRequest $request)
    {
    // اعتبارسنجی داده‌ها
    $validatedData = $request->validate([
        'name' => 'required|unique:operations',
        'price' => 'required|numeric',
        'status' => 'required',
    ]);
    // تبدیل مبلغ به تومان
    // ذخیره داده‌ها در پایگاه داده
    $operation = new Operation;
    $operation->name = $request->name;
    $operation->price = $request->price; // ذخیره مبلغ تبدیل شده در پایگاه داده
    $operation->status = $request->status; 
    $operation->save();

    $data = [
        'status' => 'success',
        'message' => 'عمل با موفقیت ثبت شد'
    ];
    return redirect()->route('admin.operations')->with($data);
}

public function update(OperationsRequest $request, Operation $operation)
{
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
        ]);

        $operation->update([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
        ]);
            $data = [
                'status' => 'success',
                'message' => 'عمل با موفقیت به روزرسانی شد'
            ];
            return redirect()->route('admin.operations')->with($data);
    }
    public function destroy(Request $request)
    {
        $id = $request->item_id;
        Operation::findOrFail($id)->delete();
        $data= [
            'status' => 'success',
            'message' => 'عمل با موفقیت حذف شد',
        ];
    
        return redirect()->back()->with($data);
    }
}
