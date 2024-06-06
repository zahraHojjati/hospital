<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Surgery;

class SurgeryController extends Controller
{
    public function index()
    {
        $doctor = auth()->guard('doctor-api')->user();
        $surgeries = $doctor->surgeries()
            ->select([
                'id',
                'patient_name',
                'patient_national_code',
                'surgeried_at',
                'released_at'
            ])
         //   ->whereHas('doctors', fn($query) => $query->where('doctor_id', $doctor->id))
            ->with([
                'doctors' => fn($query) => $query->where('doctors.id', $doctor->id),
                'operations:id,name',
            ])
            ->paginate();
        return response()->success(':)', compact('surgeries'));
//
    }

    public function show($id)
    {

        $doctor = $this->doctor;

        $surgery = Surgery::findOrFail($id);

        if (!$surgery->doctors->contains($doctor->id)) {
            return response()->error('forbidden', null, 403);
        }


        return response()->success('', compact(['surgery']));
    }
}
