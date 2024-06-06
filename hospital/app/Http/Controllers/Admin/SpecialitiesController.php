<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\specialityStoreRequest;
use App\Http\Requests\Admin\specialityUpdateRequest;
use App\Models\DoctorRole;
use App\Models\Operation;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class SpecialitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view specialities')->only('index');
        $this->middleware('can:create specialities')->only('create');
        $this->middleware('can:edit specialities')->only('edit');
        $this->middleware('can:delete specialities')->only('delete');
    }

    public function index()
    {
        $specialities=Speciality::select('id','title','status','created_at','updated_at')
            ->latest('id')
            ->paginate();
        return view('admin.speciality.index', compact('specialities'));
    }

    public function create()
    {
        return view('admin.speciality.create');
    }

    public function store(specialityStoreRequest $request)
    {
         Speciality::create([
            'title' => $request->input('title'),
            'status' => (bool)$request->input('status')
        ]);

        toastr()->success('تخصص جدید با موفقیت ثبت شد');
        return redirect()->route('admin.specialities.index');
    }

    public function edit(Speciality $speciality)
    {
        return view('admin.speciality.edit', compact('speciality'));
    }

    public function update(specialityUpdateRequest $request, Speciality $speciality)
    {
        $speciality->update([
            'title' => $request->input('title'),
            'status' => (bool)$request->input('status')
        ]);
        toastr()->success('تخصص با موفقیت ویرایش شد');
        return redirect()->route('admin.specialities.index');
    }

    public function destroy(Speciality $speciality)
    {
        $speciality->delete();
        toastr()->success('تخصص با موفقیت حذف شد');
        return redirect()->route('admin.specialities.index');
    }
}
