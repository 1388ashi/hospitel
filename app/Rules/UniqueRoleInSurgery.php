<?php

namespace App\Rules;

use App\Models\Invoice;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueRoleInSurgery implements ValidationRule
{
    protected $fillable = ['invoice_id'];
    public function passes($attribute, $value)
    {
        $invoice = Invoice::find($this->invoice_id);
        return $value <= $invoice->amount;
    }

    public function message()
    {
        return 'مبلغ وارد شده نمی تواند از مبلغ صورت حساب بیشتر باشد';
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
