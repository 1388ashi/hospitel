<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Operation extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'name',
        'price',
        'status'
    ];
    public function getActivitylogOptions() : LogOptions
    {
      $modelid = $this->attributes['id'];
      $userid = auth()->user()->id;
      $description =" عمل با شناسه {$modelid} توسط کاربر باشناسه {$userid}";
        return LogOptions::defaults()
        ->logOnly($this->fillable)
        ->setDescriptionForEvent(fn(string $eventName) => $description . __('custom.'.$eventName));
    }

    public function surguries() : BelongsToMany{
        return $this->belongsToMany(Surgery::class);
	}
    // public function getActivitylogOptions()
    // {
    //     // پیاده‌سازی متد getActivitylogOptions
    //     return LogOptions::defaults()
    //     ->logOnly(['patient_name','patient_national_code','basic_insurance_id','supp_insurance_id','document_number'
    //         ,'surgeried_at'
    //         ,'description'
    //         ,'released_at'
    //         ,'created_at'
    //     ]);
    // }
}
