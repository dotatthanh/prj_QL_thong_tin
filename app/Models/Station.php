<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
    	'unit_id',
    	'name',
    	'phone_number',
    	'address',
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }


    public function tranmissionStream()
    {
        return $this->hasMany(TransmissionStream::class);
    }

    public function getTranmissionStreamUsedAttribute()
    {
        return $this->tranmissionStream->where('thread_label', '!=', NULL)->count();
    }

    public function getTranmissionStreamDeviceAttribute()
    {
        return $this->devices->where('type', 1)->count();
    }

    public function tvStream()
    {
        return $this->hasMany(TvStream::class);
    }

    public function getTvStreamUsedAttribute()
    {
        return $this->tvStream->where('thread_label', '!=', NULL)->count();
    }

    public function getTvStreamDeviceAttribute()
    {
        return $this->devices->where('type', 2)->count();
    }
}
