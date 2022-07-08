<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCertification extends Model
{
    use HasFactory;

    protected $fillable = [
    	'title',
    	'patient_id',
    	'consulting_room_id',
    	'user_id',
    	'code',
    	'status',
        'payment_status',
    	'conclude',
    	'treatment_guide',
    	'suggestion',
    	'number',
    	'total_money',
        'is_health_insurance_card',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function consultingRoom()
    {
        return $this->belongsTo(ConsultingRoom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }
}
