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
}
