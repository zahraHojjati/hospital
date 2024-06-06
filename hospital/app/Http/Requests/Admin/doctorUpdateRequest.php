<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class doctorUpdateRequest extends FormRequest
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
        $doctorId = $this->route()->parameter('doctor')->id;
        return [
            'name' => ['required', 'string', 'max:100'],
            'speciality_id' => ['required'],
            'speciality_id.*' => ['exists:specialities,id'],
            'national_code' => ['nullable', 'string', 'numeric'],
            'medical_number' => ['nullable', Rule::unique('doctors')->ignore($doctorId), 'numeric'],
            'mobile' => ['required', 'string', Rule::unique('doctors')->ignore($doctorId), 'numeric'],
            'status' => ['required'],
            'status.*' => ['in:0,1'],
            'password' => ['nullable', 'string', 'confirmed', 'max:191']
        ];
    }
}
