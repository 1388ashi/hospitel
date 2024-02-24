<?php

namespace App\Http\Controllers\Admin;

use Cache;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Faker\Core\File;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:edit settings')->only('edit');
        $this->middleware('permission:edit settings')->only('update');
    }

    public function edit() {
        $settingTypesSocial = Setting::where('group','social')->get()->groupBy('type'); 
        $settingTypesGeneral = Setting::where('group','general')->get()->groupBy('type'); 
        $group = Setting::GROUP['social'];
        return view('admin.pages.setting.index',compact('settingTypesSocial','group','settingTypesGeneral'));
    }
    public function update(Request $request) {
        $inputs = $request->except(['_token','_method']);
        foreach ($inputs as $name => $value) {
            if ($setting = Setting::where('name',$name)->first()) {
                if ($setting->type == 'file' && $request->file($name)->isValid()) {
                    if ($setting->value) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    if(filled($request->file('logo'))){
                    $value = $request->file($name)->store("images", "public");
                    }else {
                        $value = $request->file('profile')->store('/settings/images','public');
                    }
                }
                $setting->update(['value' => $value]);
            }
        }
        return redirect()->back()->with('success','تنظیمات با موفقیت به روزرسانی شد.');
    }
    // public function updateSettingGeneral(Request $request,$id) {
    //     $inputs = $request->except(['_token','_method']);
    //     foreach ($inputs as $name => $value) {
    //         if ($setting = Setting::where('name',$name)->first()) {
    //             if ($setting->type == 'file' && $request->file($name)->isValid()) {
    //                 if ($setting->value) {
    //                     Storage::disk('public')->delete($setting->value);
    //                 }
    //                 $value = $request->file('logo')->store('/settings/images','public');
    //             }
    //             $setting->update(['value' => $value]);
    //         }
    //     }
    //     return redirect()->back()->with('success','تنظیمات با موفقیت به روزرسانی شد.');
    // }
}