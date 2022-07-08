<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
    	'code',
    	'name',
    	'avatar',
    	'gender',
    	'address',
    	'birthday',
    	'phone',
    ];

    public function healthCertifications()
    {
        return $this->hasMany(HealthCertification::class);
    }

    public function healthInsuranceCard()
    {
        return $this->hasOne(HealthInsuranceCard::class);
    }

    public function serviceVouchers()
    {
        return $this->hasMany(ServiceVoucher::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
