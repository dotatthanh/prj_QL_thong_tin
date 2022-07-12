<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
    	'station_id',
    	'name',
    	'type',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
