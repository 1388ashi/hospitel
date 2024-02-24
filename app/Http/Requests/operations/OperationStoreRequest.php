<?php

namespace App\Http\Requests\operations;

use Illuminate\Foundation\Http\FormRequest;

class OperationStoreRequest extends FormRequest
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
            'name' => 'required|unique:operations,name',
            'price' => 'required|numeric',
            'status' => 'required',
                $this->merge([
                    'price' => str_replace(',', '', $this->input('price'))
                ])
        ];
    }
}
