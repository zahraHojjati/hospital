<?php

namespace App\Http\Requests\Admin;

use App\Models\DoctorRole;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class surgeryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
           return [
               'basic_insurance_id' => [
                   'nullable',
                   'integer',
                   Rule::exists('insurances', 'id')->where(function (Builder $query) {
                       return $query->where('type', 'basic');
                   })
               ],
               'supp_insurance_id' => [
                   'nullable',
                   'integer',
                   Rule::exists('insurances', 'id')->where(function (Builder $query) {
                       return $query->where('type', 'supplementary');
                   })
               ],
               'patient_name' => 'required|string|max:100',
               'patient_national_code' => 'required|digits:10',
               'document_number' => 'required|numeric',
               'description' => 'nullable|string|max:1000',
               'surgeried_at' => 'required|date_format:Y-m-d',
               'released_at' => 'required|date_format:Y-m-d',

               'operations' => 'required|array',
               'operations.*' => 'required|integer|exists:operations,id',

               'doctors' => ['required', 'array'],
               'doctors.*' => 'nullable|integer|exists:doctors,id',
           ];
    }

    /**
     * @throws ValidationException
     */
    protected function passedValidation()
    {
        $doctors = $this->input('doctors');
        $findDuplicate = array_diff_assoc(
            $doctors,
            array_unique($doctors)
        );

        if (count($findDuplicate) > 0) {
            throw ValidationException::withMessages([
                'doctors' => ['برای هرنقش باید یک پزشک انتخاب کنید!']
            ])
                ->errorBag('default');
        }

        foreach ($doctors as $roleId => $doctorId) {
            $role = DoctorRole::find($roleId);

            if (!$role) {
                throw ValidationException::withMessages([
                    'doctors' => ['نقش پزشک وارد شده نامعتبر است!']
                ])
                    ->errorBag('default');
            }

            if ($role->required && is_null($doctorId)) {
                throw ValidationException::withMessages([
                    'doctors' => ["برای نقش {$role->title} انتخاب پزشک الزامی است."]
                ])
                    ->errorBag('default');
            }
        }
    }
}
