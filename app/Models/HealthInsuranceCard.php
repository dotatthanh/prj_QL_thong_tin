<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthInsuranceCard extends Model
{
    use HasFactory;

    protected $fillable = [
    	'patient_id',
    	'code',
    	'hospital',
    	'use_value',
    	'id_card',
    	'date_of_issue',
    	'issued_by',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
