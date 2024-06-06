<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view insurances')->only('index');
        $this->middleware('can:create insurances')->only('create');
        $this->middleware('can:edit insurances')->only('edit');
        $this->middleware('can:delete insurances')->only('delete');
    }
    public function index()
    {
        $name = request("name") !== "all" ?  request("name") : null;
//        $type = request("type") !== "all" ?  request("type") : null;
        $status = request("status") !== "all" ? request("status") : null;
        $insurances = Insurance::
           when($name, function (Builder $query) use ($name) {
                return $query->where("name", "like", "%{$name}%");
            })
//            ->when($type, function (Builder $query) use ($type) {
//                return $query->where("$type", "like", "%{$type}%");
//            })
            ->when($status, function (Builder $query) use ($status) {
                return $query->where("status", $status);
            })
            ->latest('id')
            ->get();
        return view('admin.insurance.index', compact('insurances'));
    }

    public function create()
    {
        $insurance=Insurance::all();
        return view('admin.insurance.create',compact('insurance'));
    }

    public function store(Request $request)
    {
        Insurance::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'discount' => $request->input('discount'),
            'status' =>(bool)$request->input('status')
        ]);
        toastr()->success('بیمه جدید با موفقیت ثبت شد');
        return redirect()->route('admin.insurances.index');
    }

    public function edit(Insurance $insurance)
    {
        return view('admin.insurance.edit', compact('insurance'));
    }

    public function update(Request $request, Insurance $insurance)
    {
        $insurance->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'discount' => $request->input('discount'),
            'status' => $request->input('status'),
        ]);
        toastr()->success('بیمه با موفقیت ویرایش شد');
        return redirect()->route('admin.insurances.index');
    }

    public function destroy(Insurance $insurance)
    {
        $insurance->delete();
        toastr()->success('بیمه با موفقیت حذف شد');
        return redirect()->route('admin.insurances.index');
    }

    public static function __callStatic(string $name, array $arguments)
    {
        // TODO: Implement __callStatic() method.
    }
}
