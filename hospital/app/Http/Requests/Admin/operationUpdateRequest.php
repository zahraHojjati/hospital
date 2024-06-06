<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class operationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "min:4", "max:191", "string"],
            "price" => ["required"],
            "status" => ["required"],
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'price' => str_replace(',', '', $this->input('price'))
        ]);
    }
}
