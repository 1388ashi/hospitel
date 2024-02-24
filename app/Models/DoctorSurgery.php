<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorSurgery extends Model
{
    use HasFactory;
    protected $table = 'doctor_surgery';
    protected $fillable = ['doctor_id', 'surgery_id', 'doctor_role_id', 'invoice_id', 'amount'];

    public function doctor(): BelongsTo {
        return $this->belongsTo(Doctor::class);
    }
    public function surgery(): BelongsTo {
        return $this->belongsTo(Surgery::class);
    }
    public function doctorRole(): BelongsTo
    {
        return $this->belongsTo(DoctorRole::class, 'doctor_role_id');
    }
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
    public function getDoctorQuotaAmount(): int {
        return round(($this->doctorRole->quota / 100) * $this->surgery->getTotalPrice());
    }
    public function calculateDoctorAmount()
    {
        $doctorRolePercentage = $this->doctorRole->quota;
        $surgery = $this->surgery->getTotalPrice();

        $doctorAmount = ($doctorRolePercentage / 100) * $surgery;

        $this->amount = $doctorAmount;
        $this->save();
    }

}
