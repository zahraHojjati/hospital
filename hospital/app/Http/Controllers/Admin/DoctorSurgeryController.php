<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\paymentDoctorStoreRequest;
use App\Models\Doctor;
use App\Models\DoctorRole;
use App\Models\DoctorSurgery;
use App\Models\Invoice;
use App\Models\Operation;
use App\Models\Surgery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use Yoeunes\Toastr\Facades\Toastr;

class DoctorSurgeryController extends Controller
{
   public function index()
   {
       $doctors=Doctor::query()
           ->where('status',1)
           ->with(['speciality:id,title'])
           ->select(['id', 'name', 'speciality_id'])
           ->orderBy('name')
           ->get();

       return view('admin.paymentDoctor.index',compact('doctors'));
   }


   public function create()
   {
       $fromReleasedAt = request('from_released_at');
       $toReleasedAt = request('to_released_at');
       $doctorId = request('doctor_id');

       $doctor = Doctor::findOrFail($doctorId);
       $doctorSurgeries = DoctorSurgery::query()
           ->where('invoice_id',null)
           ->where('doctor_id', $doctorId)
           ->with([
               'surgery',
               'surgery.operations:name',
               'doctorRole',
           ])
           ->when($fromReleasedAt, function (Builder $query) use ($fromReleasedAt) {
               $query->whereHas('surgery', function (Builder $query) use ($fromReleasedAt) {
                   $query->where('released_at', '>=', $fromReleasedAt);
               });
           })
           ->when($toReleasedAt, function (Builder $query) use ($toReleasedAt) {
               $query->whereHas('surgery', function (Builder $query) use ($toReleasedAt) {
                   $query->where('released_at', '<=', $toReleasedAt);
               });
           })
           ->get();

       $totalPrice = 0;
       foreach ($doctorSurgeries as $doctorSurgery) {
           $totalPrice += $doctorSurgery->amount;
       }
       return view('admin.paymentDoctor.show',
           compact([
               'doctor','doctorSurgeries','totalPrice','fromReleasedAt','toReleasedAt',
           ])
       );
   }



   public function store(paymentDoctorStoreRequest $request)
   {
       $doctorSurgeries = DoctorSurgery::query()
           ->whereIn('id',$request->input('doctor_surgery_ids'))
           ->get();
       $amount = $doctorSurgeries->sum('amount');

       $invoice = Invoice::query()->create([
           'doctor_id' => $request->input('doctor_id'),
           'amount' => $amount,
           'description' => null,
           'status' => 0,
       ]);

       $doctorSurgeries->each(function ($doctorSurgery) use ($invoice) {
           $doctorSurgery->update(['invoice_id' => $invoice->id]);
       });


       Toastr::success('برای پرداخت شما صورتحساب ایجاد شد.');
       return redirect()->route('admin.invoices.index');
   }

}
