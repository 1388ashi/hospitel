<?php

namespace App\Http\Requests\insurance;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'discount' => str_replace(',', '', $this->input('discount'))
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
            return [
            'name' => 'required|unique:insurances,name',
            'discount' => 'required|integer|between:1,100', 
            'type' => 'required', 
            'status' => 'required',
                $this->merge([
                    'discount' => str_replace(',', '', $this->input('discount'))
                ])
        ];
    }
}
