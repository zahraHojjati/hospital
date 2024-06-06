<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class doctorStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'speciality_id' => ['required'],
            'speciality_id.*' => ['exists:specialities,id'],
            'national_code' => ['nullable', 'string', 'numeric'],
            'medical_number' => ['nullable', 'string', 'numeric'],
            'mobile' => ['required', 'string', 'numeric', 'unique:doctors,mobile', 'starts_with:09'],
            'status' => ['required'],
            'status.*' => ['in:0,1'],
//            'password' => ['required', 'string', 'confirmed', 'min:6','max:191']
        ];
    }
}
