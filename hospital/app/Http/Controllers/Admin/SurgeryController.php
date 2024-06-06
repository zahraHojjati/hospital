<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\surgeryStoreRequest;
use App\Http\Requests\Admin\surgeryUpdateRequest;
use App\Models\Doctor;
use App\Models\DoctorRole;
use App\Models\DoctorSurgery;
use App\Models\Insurance;
use App\Models\Operation;
use App\Models\operationSurgery;
use App\Models\Surgery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class SurgeryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:index surgeries')->only('index');
        $this->middleware('can:view surgeries')->only('show');
        $this->middleware('can:create surgeries')->only('create');
        $this->middleware('can:edit surgeries')->only('update');
        $this->middleware('can:delete surgeries')->only('delete');
    }

    public function index()
    {
        $patient_name = request("patient_name");
        $patientNationalCode = request('patient_national_code');
        $operation_id = request("operation_id") !== "all" ? request("operation_id") : null;
        $fromSurgeriedAt = request('from_surgeried_at');
        $toSurgeriedAt = request('to_surgeried_at');
        $fromReleasedAt = request('from_released_at');
        $toReleasedAt = request('to_released_at');
        $surgeries = Surgery::query()
            ->when($patient_name, fn (Builder $query) => $query->where('patient_name', 'like', "%$patient_name%"))
            ->when($patientNationalCode, fn (Builder $query) => $query->where('patient_national_code', 'like', "%$patientNationalCode%"))
            ->when($fromSurgeriedAt, fn (Builder $query) => $query->where('surgeried_at', '>=', $fromSurgeriedAt))
            ->when($toSurgeriedAt, fn (Builder $query) => $query->where('surgeried_at', '<=', $toSurgeriedAt))
            ->when($fromReleasedAt, fn (Builder $query) => $query->where('released_at', '>=', $fromReleasedAt))
            ->when($toReleasedAt, fn (Builder $query) => $query->where('released_at', '<=', $toReleasedAt))
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        $surgeriesCount = $surgeries->total();

        return view('admin.surgery.index', compact([
            'patient_name','patientNationalCode','operation_id','surgeries','surgeriesCount'
        ]));
    }

    public function show(Surgery $surgery)
    {
        $insurances=Insurance::query()->select(['id','name'])->get();
        return view('admin.surgery.show', compact(['insurances','surgery']));
    }

    public function create()
    {
        $doctorRoles = DoctorRole::query()
            ->with('doctors')
            ->where('status', 1)
            ->get(['id', 'title', 'required']);

        $operations = Operation::query()
            //->where('status', 1)
            ->pluck('name', 'id');

        $insurances = Insurance::query()->select(['id', 'name', 'type'])->get();
        $basicInsurances = $insurances->where('type', 'basic');
        $suppInsurances = $insurances->where('type', 'supplementary');
        return view('admin.surgery.create',
            compact(['doctorRoles', 'operations', 'basicInsurances', 'suppInsurances']));
    }


    public function store(surgeryStoreRequest $request)
    {
        $surgery = Surgery::query()->create($request->validated());
        //attach operations
        $attachOperations = [];
        foreach ($request->input('operations') as $operationId) {
            $operation = Operation::find($operationId);
            $attachOperations[$operationId] = ['amount' => $operation->price];
        }
        $surgery->operations()->attach($attachOperations);

        //attach doctors
        $attachDoctors = [];
        foreach ($request->input('doctors') as $roleId => $doctorId) {
            if ($doctorId) {
                $doctorRole = DoctorRole::find($roleId);
                $amount = $surgery->getDoctorQuotaAmount($doctorRole);
                $attachDoctors[$doctorId] = ['doctor_role_id' => $roleId, 'amount' => $amount];
            }
        }
        $surgery->doctors()->attach($attachDoctors);
        toastr()->success('جراحی جدید با موفقیت ایجاد شد');
        return redirect()->route('admin.surgeries.index');
    }


    public function edit(Surgery $surgery)
    {
        $doctorRoles = DoctorRole::query()
            ->with('doctors')
            ->where('status', 1)
            ->get(['id', 'title', 'required']);

        $operations = Operation::query()
            //->where('status', 1)
            ->pluck('name', 'id');

        $insurances = Insurance::query()->select(['id', 'name', 'type'])->get();
        $basicInsurances = $insurances->where('type', 'basic');
        $suppInsurances = $insurances->where('type', 'supplementary');
        return view('admin.surgery.edit', compact('surgery','doctorRoles', 'operations', 'insurances', 'basicInsurances', 'suppInsurances'));
    }

    public function update(SurgeryUpdateRequest $request, Surgery $surgery)
    {
        $surgery->update($request->validated());
        //attach operations
        $syncOperations = [];
        foreach ($request->input('operations') as $operationId) {
            $operation = Operation::find($operationId);
            $syncOperations[$operationId] = ['amount' => $operation->price];
        }
        $surgery->operations()->sync($syncOperations);

        //attach doctors
        $syncDoctors = [];
        foreach ($request->input('doctors') as $roleId => $doctorId) {
            if ($doctorId) {
                $doctorRole = DoctorRole::find($roleId);
                $amount = $surgery->getDoctorQuotaAmount($doctorRole);
                $syncDoctors[$doctorId] = ['doctor_role_id' => $roleId, 'amount' => $amount];
            }
        }
        $surgery->doctors()->sync($syncDoctors);
        toastr()->success('جراحی جدید با موفقیت ویرایش شد');
        return redirect()->route('admin.surgeries.index');
    }

            public function destroy(Surgery $surgery)
        {
            $surgery->delete();
            $surgery->operations()->detach();
            $surgery->doctors()->detach();
            toastr()->success('جراحی با موفقیت حذف شد');
            return redirect()->route('admin.surgeries.index');
        }

}
