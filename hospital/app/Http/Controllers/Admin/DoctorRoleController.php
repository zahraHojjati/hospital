<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\doctorRoleStoreRequest;
use App\Http\Requests\Admin\doctorRoleUpdateRequest;
use App\Models\DoctorRole;
use App\Models\Operation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class DoctorRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view doctor_roles')->only('index');
        $this->middleware('can:create doctor_roles')->only('create');
        $this->middleware('can:update doctor_roles')->only('update');
        $this->middleware('can:delete doctor_roles')->only('delete');
    }
    public function index()
    {
        $doctorRoles=DoctorRole::select('id','title','status','required','quota','created_at','updated_at')
            ->latest('id')
            ->paginate();

        return view('admin.doctorRole.index',compact('doctorRoles'));
    }
    public function create()
    {
        return view('admin.doctorRole.create');
    }
    public function store(doctorRoleStoreRequest $request)
    {
         DoctorRole::create([
            'title' => $request->input('title'),
            'required' => (bool)$request->input('required'),
            'quota' => $request->input('quota'),
            'status' => (bool)$request->input('status')
        ]);

        toastr()->success('نقش جدید با موفقیت ثبت شد');
        return redirect()->route('admin.doctorRoles.index');
    }

    public function edit(DoctorRole $doctorRole)
    {
        return view('admin.doctorRole.edit', compact('doctorRole'));
    }

    public function update(doctorRoleUpdateRequest $request, DoctorRole $doctorRole)
    {
        $doctorRole->update([
            'title' => $request->input('title'),
            'required' => (bool)$request->input('required'),
            'quota' => $request->input('quota'),
            'status' => (bool)$request->input('status')
        ]);
        toastr()->success('نقش با موفقیت ویرایش شد');
        return redirect()->route('admin.doctorRoles.index');
    }

    public function destroy(DoctorRole $doctorRole)
    {
        $doctorRole->delete();
        toastr()->success('نقش با موفقیت حذف شد');
        return redirect()->route('admin.doctorRoles.index');
    }

}
