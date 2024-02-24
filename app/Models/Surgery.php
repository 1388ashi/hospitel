<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Surgery extends Model
{
    use HasFactory, LogsActivity;
	
	protected $fillable = [
        'patient_name',
        'patient_national_code',
        'basic_insurance_id',
        'supp_insurance_id',
        'document_number',
        'surgeried_at',
        'description',
        'released_at',
        'created_at',
        'updated_at',
    ];
    public function getActivitylogOptions() : LogOptions
    {
      $modelid = $this->attributes['id'];
      $userid = auth()->user()->id;
      $description =" جراحی با شناسه {$modelid} توسط کاربر باشناسه {$userid}";
        return LogOptions::defaults()
        ->logOnly($this->fillable)
        ->setDescriptionForEvent(fn(string $eventName) => $description . __('custom.'.$eventName));
    }
    public function basicInsurance(){
		return $this->belongsTo(Insurance::class,'basic_insurance_id');
    }
    public function suppInsurance(){
		return $this->belongsTo(Insurance::class,'supp_insurance_id');
    }
    public function doctorSurgery() : BelongsToMany{
		return $this->belongsToMany(DoctorSurgery::class);
    }
    public function doctorRoles() : BelongsToMany{
		return $this->belongsToMany(DoctorRole::class);
    }
  
  public function getTotalPrice(): int
  {
      return (int) $this->operations->sum('pivot.amount');
  }

  public function getDoctorQuotaAmount(DoctorRole $doctorRole): int
  {
      return round(((int) $doctorRole->quota / 100) * $this->getTotalPrice());
  }

  public function operations(): BelongsToMany
  {
      return $this->belongsToMany(Operation::class, 'operation_surgery')
          ->withPivot(['amount']);
  }

  public function doctors(): BelongsToMany
  {
      return $this->belongsToMany(Doctor::class, 'doctor_surgery')
          ->withPivot(['doctor_role_id', 'amount']);
  }
}
