<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\paymentStoreRequest;
use App\Http\Requests\Admin\paymentUpdateRequest;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $invoices=Invoice::query()->get(['id','doctor_id','amount']);
        $payments = Payment::query()->select(['id', 'invoice_id', 'amount', 'pay_type', 'receipt', 'status'])
            ->latest('id')
//            ->paginate()
            ->get();
        return view('admin.payment.index', compact(['invoices','payments']));
    }

    public function show(Payment $payment)
    {
        return view('admin.payment.show', compact('payment'));
    }

    public function create(Invoice $invoice)
    {
        $payment = Payment::query()->get();
//        $payment = Payment::all();
        return view('admin.payment.create', compact(['invoice','payment']));
    }

    public function store(paymentStoreRequest $request)
    {
        $inputs = [
            'invoice_id' => $request->input('invoice_id'),
            'amount' => $request->input('amount'),
            'pay_type' => $request->input('pay_type'),
            'due_date' => $request->input('due_date'),
            'description' => $request->input('description'),
            'status' => 1
        ];
        if ($request->hasFile('receipt') && $request->file('receipt')->isValid()) {
            $inputs['receipt'] = $request->file('receipt')->store('images/payments', 'public');
        }
        Payment::query()->create($inputs);
        $invoice = Invoice::query()->findOrFail($request->invoice_id);
        if ($invoice->getSumPaymentAmount() == $invoice->amount) {
            $invoice->update(['status' => 1]);
        }
        toastr()->success('فاکتور با موفقیت ثبت شد');
        return redirect()->route('admin.payments.index');
    }

    public function edit(Payment $payment)
    {
        $invoices=Invoice::query()->select(['id','doctor_id','amount','description','status'])->get();
//        $payment = Payment::find($payment);
        return view('admin.payment.edit', compact(['payment','invoices']));
    }

    public function update(paymentUpdateRequest $request, Payment $payment)
    {
        $inputs = [
            'amount' => $request->input('amount'),
            'pay_type' => $request->input('pay_type'),
            'due_date' => $request->input('due_date'),
            'description' => $request->input('description'),
            'status' => 1
        ];

        if ($request->hasFile('receipt')) {
            Storage::delete($payment->receipt);
            $inputs["receipt"] = $request->file("receipt")->store("images/payments", "public");
        }
        $payment->update($inputs);
        $invoice=Invoice::query()->findOrFail($payment->invoice_id);
        if ($request->status == 0 && $invoice->status == 1){
            $invoice->update(['status'=> 0]);
        }else {

            if ($invoice->getSumPaymentAmount() == $invoice->amount) {
                $invoice->update(['status' => 1]);
            } elseif ($invoice->getSumPaymentAmount() < $invoice->amount && $invoice->status == 1) {
                $invoice->update(['status' => 0]);
            }
        }
        toastr()->success('فاکتور با موفقیت ویرایش شد');
        return redirect()->route('admin.payments.index');
    }

    public function destroy(Payment $payment)
    {
        $payment = Payment::find($payment);
        $payment->delete();
    }
}
