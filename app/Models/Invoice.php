<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Invoice extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'amount',
        'status',
        'description',
        'doctor_id'
    ];
    public function doctor() : BelongsTo{
        return $this->belongsTo(Doctor::class);
	}

    public function payments() :  HasMany{
		return $this->hasMany(Payment::class);
    }
    
    public function getActivitylogOptions() : LogOptions
    {
        $modelid = $this->attributes['id'];
        $userid = auth()->user()->id;
        $description =" صورتحساب با شناسه {$modelid} توسط کاربر باشناسه {$userid}";
        return LogOptions::defaults()
        ->logOnly($this->fillable)
        ->setDescriptionForEvent(fn(string $eventName) => $description . __('custom.'.$eventName));
    }

    public function getSumPaymentAmount(): int{
        return (int) $this->payments->where('status',1)->sum('amount');
    }
    public function getRemainningAmount(): int{
        return (int) $this->attributes['amount'] - $this->getSumPaymentAmount();
    }
}
