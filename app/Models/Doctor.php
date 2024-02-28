<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Doctor extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'name',
        'specialties_id',
        'national_code',
        'medical_number',
        'mobile',
        'email',
        'password',
        'status'
    ];
    public function getActivitylogOptions() : LogOptions
    {
      $modelid = $this->attributes['id'];
      $userid = auth()->user()->id;
      $description =" دکتر با شناسه {$modelid} توسط کاربر باشناسه {$userid}";
        return LogOptions::defaults()
        ->logOnly($this->fillable)
        ->setDescriptionForEvent(fn(string $eventName) => $description . __('custom.'.$eventName));
    }
    public function doctorRoles() : BelongsToMany{
        return $this->belongsToMany(DoctorRole::class);
	}
    public function surgeries(): BelongsToMany
    {
        return $this->belongsToMany(Surgery::class,'doctor_surgery');
    }
    public function specialtie() : BelongsTo
    {
        return $this->belongsTo(specialties::class ,'specialties_id');
    }
    public function attachOrSyncDoctorRoles(array $roles,Bool $Onupdate = false)
    {
        $roleIds = [];
        foreach ($roles as $role) {
            $doctorRole = DoctorRole::firstOrCreate([
                'title' => $role
            ]);
            $roleIds[] = $doctorRole->id;
        }
        $Onupdate ? $this->doctorRoles()->sync($roleIds) : $this->doctorRoles()->attach($roleIds);
    }

    public function invoices() : HasMany{
        return $this->hasMany(Invoice::class);
	}
    public function payments() : HasManyThrough{
        return $this->hasManyThrough(Payment::class,Invoice::class);
	}
}
