<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Insurance;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Surgery;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $insurancesCount = Insurance::all()->count();
        $doctorsCount = Doctor::all()->count();
        $surgeriesCount = Surgery::all()->count();
        $paymentsCount = Payment::all()->count();

        $invoices = Invoice::query()
            ->select('id', 'doctor_id', 'amount', 'created_at')
            ->with('doctor:id,name,speciality_id')
            ->where('status', 0)
            ->latest('id')
            ->take(10)
            ->get();

        $logs = Activity::query()
            ->select('id', 'description', 'created_at')
            ->latest('id')
            ->take(10)
            ->get();

        return view("admin.dashboard.dashboard", compact([
            'insurancesCount',
            'doctorsCount',
            'surgeriesCount',
            'paymentsCount',
            'invoices',
            'logs'
        ]));
    }

}
