<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class paymentUpdateRequest extends FormRequest
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
       $payment= $this->route('payment');
       $maximumAmount= (int) ($payment->invoice->getRemainingAmount() + $payment->amount);
        return [
            'amount' => ['required', 'numeric', 'max:'.$maximumAmount],
            'pay_type' => ['required', 'in:cash,cheque'],
            'due_date' => ['nullable','required_if:pay_type,cheque', 'date', 'after_or_equal:' . today()],
            'receipt' => ['nullable', 'image', 'mimes:png,jpg'],
            'description' => ['nullable', 'string', 'max:1000']
            ];
    }
}
