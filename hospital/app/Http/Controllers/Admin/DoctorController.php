<?php

namespace App\Http\Controllers\Admin;

use App\Events\DoctorRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\doctorStoreRequest;
use App\Http\Requests\Admin\doctorUpdateRequest;
use App\Models\Doctor;
use App\Models\DoctorRole;
use App\Models\Operation;
use App\Models\Speciality;
use App\Models\Surgery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Comment\Doc;
use Spatie\Permission\Models\Permission;
use Yoeunes\Toastr\Facades\Toastr;
use function Laravel\Prompts\password;
use Illuminate\Database\Eloquent\Collection;

class
DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view doctors')->only('index');
        $this->middleware('can:show doctors')->only('show');
        $this->middleware('can:create doctors')->only('create');
        $this->middleware('can:edit doctors')->only('edit');
        $this->middleware('can:delete doctors')->only('delete');
    }

    public function index()
    {
        $name = request('name');
        $specialityId = request('speciality_id');
        $medicalNumber = request('medical_number');

        $doctors = Doctor::query()
            ->with('speciality:id,title')
            ->select(['id', 'name', 'email', 'speciality_id', 'medical_number', 'mobile', 'status', 'created_at'])
            ->when($name, fn (Builder $query) => $query->where('name', $name))
            ->when($specialityId, fn (Builder $query) => $query->where('speciality_id', $specialityId))
            ->when($medicalNumber, fn (Builder $query) => $query->where('medical_number', 'like', "%$medicalNumber%"))
            ->latest('id')
            ->paginate(15)
            ->withQueryString()
        ;

        $doctorsCount = $doctors->total();
        $specialities = Speciality::query()->where('status', 1)->get();
        return view('admin.doctor.index', compact(['doctors','doctorsCount','specialities']));
    }

    public function create()
    {
        $doctorRoles = DoctorRole::select('id', 'title')->get();
        $specialities = Speciality::all();
        return view('admin.doctor.create', compact(['specialities', 'doctorRoles']));
    }

    public function show(Doctor $doctor)
    {
        $doctors = Doctor::find($doctor);
        return view('admin.doctor.show', compact('doctors'));
    }

    public function store(doctorStoreRequest $request): RedirectResponse
    {
//        dd($request->doctor)
        $doctor = Doctor::create([
            'name' => $request->input('name'),
            'speciality_id' => $request->input('speciality_id'),
            'national_code' => $request->input('national_code'),
            'medical_number' => $request->input('medical_number'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'password' => bcrypt('password'),
            'status' => (bool)$request->input('status')
        ]);
        $doctorRoles = $request->input('doctor_roles');
//        if ($doctorRoles != null) {

            $doctor->attachRoles($doctorRoles);

        //event
        if($request->filled('email')){
            DoctorRegistered::dispatch($doctor);
        }

        toastr()->success('پزشک جدید با موفقیت ثبت شد');
        return redirect()->route('admin.doctors.index');
    }

    public function edit(Doctor $doctor)
    {
        $specialities = Speciality::query()->select('id', 'title')->where('status', 1)->get();
        $doctorRoles = DoctorRole::query()->select('id', 'title')->where('status', 1)->get();
        return view('admin.doctor.edit', compact([ 'doctor','doctorRoles','specialities']));
    }

    public function update(doctorUpdateRequest $request, Doctor $doctor)
    {
        $inputs = [
            'name' => $request->name,
            'speciality_id'	=> $request->speciality_id,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'status' => $request->status,
            'national_code' => null,
            'medical_number' => null,
        ];

        filled($request->national_code) ? $inputs['national_code'] = $request->national_code : 0 ;
        filled($request->medical_number) ? $inputs['medical_number'] = $request->medical_number : 0 ;
        filled($request->passsword) ? $inputs['passsword'] = Hash::make($request->password) : 0 ;

        $doctor->update($inputs);
        $doctor->doctorRoles()->sync($request->doctor_roles);

        Toastr::success('دکتر با موفقیت ویرایش شد.');
        return redirect()->route('admin.doctors.index');
    }

    public function destroy(Doctor $doctor)
    {
//        $exists = Doctor::where("speciality_id", $doctor->id)->exists();
//        if ($exists) {
//            toastr()->error("در این تخصص پزشک ثبت شده است  و نمی توان آن را حذف کرد.");
//            return redirect()->back();
//        }
        $doctor->doctorRoles()->detach();
        $doctor->delete();
        toastr()->success('پزشک با موفقیت حذف شد');
        return redirect()->route('admin.doctors.index');
    }

}
