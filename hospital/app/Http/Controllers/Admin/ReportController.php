<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorSurgery;
use App\Models\Insurance;
use App\Models\Invoice;
use App\Models\Operation;
use App\Models\OperationSurgery;
use App\Models\Surgery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use function Laravel\Prompts\select;

class ReportController extends Controller
{
    public function index()
    {
        $doctors = Doctor::query()->where('status', '=', 1)->select(['id', 'name', 'speciality_id'])->get();
        $surgeries = Surgery::query()->select(['id', 'surgeried_at'])->get();

        return view('admin.doctorReport.index', compact('doctors', 'surgeries'));
    }


    public function show()
    {
        $fromSurgeriedAt = request('from_surgeried_at');
        $toSurgeriedAt = request('to_surgeried_at');
        $doctorId = request('doctor_id');
//
        $doctor = Doctor::findOrFail($doctorId);
        $doctorSurgeries = DoctorSurgery::query()
            ->where('doctor_id', $doctorId)
            ->with(['doctorRole', 'surgery', 'invoice'])
            ->get();

        return view('admin.doctorReport.show', compact([
            'fromSurgeriedAt', 'toSurgeriedAt', 'doctor', 'doctorSurgeries'
        ]));
    }

    public function insuranceIndex()
    {
        $surgeries = Surgery::query()
            ->select(['id', 'patient_name', 'patient_national_code', 'basic_insurance_id', 'supp_insurance_id', 'released_at'])
            ->get();
        return view('admin.insuranceReport.index', compact('surgeries'));
    }

    public function insuranceShow()
    {
        $insuranceType = request('insurance_type');
        $insuranceId = request('insurance_id');
        $fromDate = request('from_date');
        $toDate = request('to_date') ?: now();
        // Validation
        $validatedData = $this->validate(request(), [
            'insurance_type' => ['required', Rule::in(['basic', 'supplementary'])],
            'insurance_id' => ['required', Rule::exists('insurances', 'id')->where(fn($query) => $query->where('type', $insuranceType))],
            'from_date' => ['required', 'date'],
            'to_date' => ['nullable', 'date', 'after_or_equal:from_date'],
        ]);

        $surgeries = Surgery::query()
            ->select(['id', 'patient_name', 'patient_national_code', 'basic_insurance_id', 'supp_insurance_id', 'released_at'])
            ->with('operations:id,name')
            ->whereBetween('released_at', [$fromDate, $toDate]) // Ensure the date range is correct
            ->when($validatedData['insurance_type'], fn($query, $type) => $query->where($type === 'basic' ? 'basic_insurance_id' : 'supp_insurance_id', $validatedData['insurance_id'])
            )
            ->get();

        $insurance = Insurance::query()
            ->select(['id', 'name', 'type', 'discount'])
            ->where('id', $insuranceId)
            ->with(['basicSurgeries', 'suppSurgeries'])
            ->first();
        return view('admin.insuranceReport.show',
            compact([
                'surgeries',
                'insurance',
                'insuranceType',
                'fromDate',
                'toDate'
            ])
        );
    }

    public
    function getInsurances(Request $request)
    {
        $type = $request->input('type');
        $insurances = Insurance::where('type', $type)->get();
        $options = '';
        foreach ($insurances as $insurance) {
            $options .= '<option value="' . $insurance->id . '">' . $insurance->name . '</option>';
        }
        return response()->json($options);
//        $insurances = Insurance::select('id', 'name')->where('type', $request->data)->orderBy('id', 'desc')->get();
//
//        return response()->json($insurances);
    }
}

