<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DoctorRole extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'title',
        'status',
        'required',
        'quota'

    ];
    public function getActivitylogOptions() : LogOptions
    {
      $modelid = $this->attributes['id'];
      $userid = auth()->user()->id;
      $description =" نقش دکتر با شناسه {$modelid} توسط کاربر باشناسه {$userid}";
        return LogOptions::defaults()
        ->logOnly($this->fillable)
        ->setDescriptionForEvent(fn(string $eventName) => $description . __('custom.'.$eventName));
    }
    public function doctors() : BelongsToMany{
      return $this->belongsToMany(Doctor::class);
    }
    public function surguries() : BelongsToMany{
      return $this->belongsToMany(Surgery::class);
    }
}
