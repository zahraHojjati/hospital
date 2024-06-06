<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SttingUpdateRequest;
use App\Models\Setting;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Yoeunes\Toastr\Facades\Toastr;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view setting groups')->only('index');
        $this->middleware('permission:edit settings')->only(['edit', 'update']);
        $this->middleware('permission:delete file')->only('destroyFile');
    }
    public function index()
    {
        return view('Admin.Setting.index');
    }

    public function edit(String $group)
    {
        $settingTypes = Setting::query()->where('group', $group)->get()->groupBy('type');
        $group = Setting::GROUP[$group];

        return view('Admin.Setting.edit', compact(['settingTypes', 'group']));
    }

    public function update(SttingUpdateRequest $request)
    {
        $inputs = $request->except(['_token', '_method']);

        foreach ($inputs as $name => $value) {
            if ($setting = Setting::where('name', $name)->first()) {
                if ($setting->type == 'image' || $request->file($name)->isValid()) {
                    if ($setting->value) {
                        Storage::delete($setting->value);
                    }
                    $value = $request->file($name)->store('images', 'public');
                }
                $setting->update(['value' => $value]);
            }
        }

        Toastr::success('تنظیات با موفقیت بروزرسانی شد.');

        return redirect()->route('admin.settings.index');
    }

    public function destroyFile(Setting $setting)
    {
        if($setting->type !== 'image') {
            Toastr::warning('تایپ فایل انتخاب شده برابر با عکس نیست.');
        }else{
            Storage::delete($setting->value);
            Toastr::success('فایل با موفقیت حذف شد.');
        }
        if (Cache::has('setting')){
            Cache::forget('setting');
        }

        return redirect()->back();
    }
}
