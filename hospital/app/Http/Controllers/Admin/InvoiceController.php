<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InvoiceUpdateRequest;
use App\Http\Requests\invoiceStoreRequest;
use App\Models\Doctor;
use App\Models\DoctorSurgery;
use App\Models\Insurance;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use Yoeunes\Toastr\Facades\Toastr;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:index invoices')->only('index');
        $this->middleware('can:view invoices')->only('show');
        $this->middleware('can:create invoices')->only('create');
        $this->middleware('can:edit invoices')->only('update');
        $this->middleware('can:delete invoices')->only('delete');
    }
    public function index()
    {
        $doctors=Doctor::query()->get(['id','name']);
        $invoices =Invoice::query()
            ->latest('id')
            ->get();
        return view('Admin.invoice.index', compact(['doctors','invoices']));
    }

    public function show(Invoice $invoice)
    {
        $doctors=Doctor::query()->get(['id','name']);
        $surgeries = DoctorSurgery::query()
            ->where('invoice_id','=',$invoice->id)->get();
        return view('Admin.invoice.show', compact(['invoice','surgeries','doctors']));
    }

    public function edit(Invoice $invoice)
    {
        return view('Admin.invoice.edit', compact('invoice'));
    }

    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        $invoice ->update([
            'description' => $request->input('description'),
        ]);
        toastr()->success('توضیحات صورتحساب با موفقیت ویرایش شد');

        return redirect()->route('admin.invoices.index');
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->payments) {
            Toastr::success('مبلغی از این صورتحساب پرداخت شده و نمی توان حذفش کرد.');
            return redirect()->back();
        }

        $invoice->delete();
        DoctorSurgery::where('invoice_id', $invoice->id)->update(['invoice_id' => null]);

        Toastr::success('صورتحساب با موفقیت حذف شد.');
        return redirect()->back();
    }
//        if ($invoice->status==1)
//        {
//            toastr()->warning('این صورت حساب پرداخت شده است،حذف امکان پذیر نیست');
//            return redirect()->route('admin.invoices.index');
//        }else{
//            $doctorSurgery=DoctorSurgery::query()
//                ->where('invoice_id','=',$invoice->id)->get();
//            $doctorSurgery->each(function ($doctorSurgery) {
//                $doctorSurgery->update(['invoice_id' => null]);
//            });
//            $invoice->delete();
//            toastr()->success('صورتحساب با موفقیت حذف شد');
//            return redirect()->route('admin.invoices.index');
//        }
//    }
}
