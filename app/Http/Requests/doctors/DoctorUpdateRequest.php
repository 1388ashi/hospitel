<?php

namespace App\Http\Requests\doctors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorUpdateRequest extends FormRequest
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
        $doctorId = $this->route()->parameter('doctor');
        return [
            'name' => 'required',
            'medical_number' => ['nullable',Rule::unique('doctors')->ignore($doctorId),'numeric'],
            'mobile' => ['required','string',Rule::unique('doctors')->ignore($doctorId),'numeric'],
            'password' => 'nullable|max:12|confirmed',
            'status' => 'required',
        ];
    }
}
