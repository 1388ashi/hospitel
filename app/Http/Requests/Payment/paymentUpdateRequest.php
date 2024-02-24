<?php

namespace App\Http\Requests\Payment;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Rule;

class paymentUpdateRequest extends FormRequest
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
            'amount' => str_replace(',', '', $this->input('amount'))
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $payment = $this->route('payment');
        $maxAmount = (int) ($payment->invoice->getRemainningAmount() + $payment->amount); 
        return [
            'amount' => ['string', 'max:'.$maxAmount],
            'pay_type' => ['required','in:cash,cheque'],
            'due_date' => ['nullable','required_if:pay_type,cheque', 'date','after_or_equal:'.today()],
            'recipt' => ['nullable','image','mimes:png,jpg'],
            'description' => ['nullable','string','max:1000'],
            
        ];
    }
}
// class ValidateAmount implements Rule
// {
//     public function passes($attribute, $value)
//     {
//         $invoiceId = request()->input('invoice_id');
//         $invoiceAmount = Invoice::find($invoiceId)->amount;
//         return $value <= $invoiceAmount;
//     }

//     public function message()
//     {
//         return __('validation.amount.validate_amount');
//     }
// }
