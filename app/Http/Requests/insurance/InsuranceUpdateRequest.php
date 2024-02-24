<?php

namespace App\Http\Requests\insurance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InsuranceUpdateRequest extends FormRequest
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
        $Id = $this->route()->parameter('insurance')->id;
            return [
            'name' => ['required',Rule::unique('insurances')->ignore($Id)],
            'discount' => 'required|integer|between:1,100', 
            'type' => 'required', 
            'status' => 'required',
                $this->merge([
                    'discount' => str_replace(',', '', $this->input('discount'))
                ])
        ];
    }
}
