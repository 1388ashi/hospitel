<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Insurance extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'name',
        'type',
        'discount',
        'status'
    ];
    public function getActivitylogOptions() : LogOptions
    {
      $modelid = $this->attributes['id'];
      $userid = auth()->user()->id;
      $description =" بیمه با شناسه {$modelid} توسط کاربر باشناسه {$userid}";
        return LogOptions::defaults()
        ->logOnly($this->fillable)
        ->setDescriptionForEvent(fn(string $eventName) => $description . __('custom.'.$eventName));
    }
}
