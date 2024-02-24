<?php

namespace App\Http\Requests\surguries;

use App\Models\DoctorRole;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SurguriesStoreRequest extends FormRequest
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
        return  [
            'insurance_basic' => [
                'nullable',
                'integer',
                Rule::exists('insurances', 'id')->where(function (Builder $query) {
                    return $query->where('type', 'basic');
                })
            ],
            'insurance_supplementary' => [
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
            'surgeried_at' => 'required|date_format:Y-m-d|before_or_equal:' . today()->format('Y--m-d'),
            'released_at' => 'required|date_format:Y-m-d|after_or_equal:' . $this->input('surgeried_at'),

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
    }
}
