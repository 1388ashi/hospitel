<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id' ,'!=', Auth::user()->id)->orderBy('id','desc')->paginate();
        return view('Admin.pages.users.index', ['users' => $users]);
    }
    
    public function create()
    {
        $admin = Role::findByName('admin');
        $permissions = $admin->permissions;
        return view('Admin.pages.users.create',['permissions' => $permissions]);
    }
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'label' => 'ادمین',
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
        ]);
        // اختصاص نقش admin به کاربر
        $user->assignRole('admin');

        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            foreach ($permissions as $permissionId) {
                $permission = Permission::find($permissionId);
                if ($permission) {
                    $user->givePermissionTo($permission);
                }
            }
        }
        $data = [
            'status' => 'success',
            'message' => 'ادمین با موفقیت ثبت شد',
        ];
        return redirect()->route('admin.users.index')->with($data);
    }
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        $permission_all = Permission::all();
        return view('Admin.pages.users.edit')->with(compact('admin','permission_all'));
    }
    public function update(UserRequest $request, $id)
    {
        // یافتن ادمین بر اساس شناسه
        $admin = User::findOrFail($id);
        if (filled($request->password)) {
            $password = $request->password;
        }else{
            $password = $admin->password;
        }
        // آپدیت سایر فیلدهای ادمین
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $password,
        ]);
        // مجوزهای جدید انتخاب شده از فرم
        $newPermissions = $request->input('permissions', []);

        // مجوزهای قبلی ادمین
        $oldPermissions = $admin->getDirectPermissions()->pluck('id')->toArray();

        // مجوزهایی که باید از ادمین حذف شوند
        $permissionsToRemove = array_diff($oldPermissions, $newPermissions);

        // مجوزهایی که باید به ادمین اضافه شوند
        $permissionsToAdd = array_diff($newPermissions, $oldPermissions);

        // حذف مجوزهایی که نیاز به حذف دارند
        foreach ($permissionsToRemove as $permissionId) {
            $permission = Permission::findOrFail($permissionId);
            if ($permission) {
                $admin->revokePermissionTo($permission);
            }
        }
        // اضافه کردن مجوزهایی که نیاز به اضافه کردن دارند
        foreach ($permissionsToAdd as $permissionId) {
            $permission = Permission::find($permissionId);
            if ($permission) {
                $admin->givePermissionTo($permission);
            }
        }
        $data = [
            'status' => 'success',
            'message' => 'ادمین با موفقیت به روزرسانی شد',
        ];
        // بازگشت به صفحه‌ی مدیریت ادمین‌ها یا یک صفحه دیگر
        return redirect()->route('admin.users.index')->with($data);
    }
    public function destroy(Request $request)
    {
        $id = $request->item_id;
        $user =  User::findOrFail($id)->delete();
        // $user->permissions()->delete();
        $data = [
        'status' => 'success',
        'message' => 'خبر با موفقیت حذف شد',
        ];
        return redirect()->back()->with($data);
    }
}
