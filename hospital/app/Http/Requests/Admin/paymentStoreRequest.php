<?php

namespace App\Http\Requests\Admin;

use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;

class paymentStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'amount' => str_replace(',', '', $this->input('amount'))
        ]);
    }

    public function rules(): array
    {
        $invoice = Invoice::findOrFail($this->input('invoice_id'));
        return [
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'amount' => ['required', 'numeric', 'max:' . $invoice->getRemainingAmount()],
            'pay_type' => ['required', 'in:cash,cheque'],
            'due_date' => ['nullable','required_if:pay_type,cheque', 'date', 'after_or_equal:' . today()],
            'receipt' => ['nullable', 'image', 'mimes:png,jpg'],
            'description' => ['nullable', 'string', 'max:1000']
        ];
    }
}
