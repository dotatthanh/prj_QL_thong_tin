<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
	    'code',
	    'patient_id',
	    'user_id',
	    'total_money',
	    'status',
        'is_health_insurance_card',
        'health_certification_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prescriptionDetails()
    {
        return $this->hasMany(PrescriptionDetail::class);
    }

    public function healthCertification()
    {
        return $this->belongsTo(HealthCertification::class);
    }
}
