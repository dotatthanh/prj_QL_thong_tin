<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
    	'code',
    	'patient_id',
    	'medical_service_id',
        'is_health_insurance_card',
    	'user_id',
    	'start_date',
    	'end_date',
    	'total_money',
    	'status',
        'payment_status'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medicalService()
    {
        return $this->belongsTo(MedicalService::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceVoucherDetails()
    {
        return $this->hasMany(ServiceVoucherDetail::class);
    }
}
