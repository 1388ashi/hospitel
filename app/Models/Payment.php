<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'invoice_id',
        'amount',
        'pay_type',
        'recipt',
        'description',
        'due_date',
        'notified_at',
        'status'
    ];

    public function getActivitylogOptions() : LogOptions
    {
        $modelid = $this->attributes['id'];

        $userid = auth()->check() ? auth()->user()->id : null;
        $description =" پرداخت با شناسه {$modelid} توسط کاربر باشناسه {$userid}";
        return LogOptions::defaults()
        ->logOnly($this->fillable)
        ->setDescriptionForEvent(fn(string $eventName) => $description . __('custom.'.$eventName));
    }
    public function invoice() : BelongsTo{
        return $this->belongsTo(Invoice::class);
	}
    public function getPayType(){
        return $this->pay_type == 'cash' ? 'نقدی' : 'چک'; 
	}
}
