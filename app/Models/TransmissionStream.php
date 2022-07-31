<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransmissionStream extends Model
{
    use HasFactory;

    protected $fillable = [
    	'station_id',
        'device_id',
    	'name_card',
    	'port_origin',
    	'signal_type',
    	'coordinates_origin',
    	'thread_label',
    	'service',
    	'station',
    	'device',
    	'coordinates_remote',
    	'port_remote',
    	'note',
    ];

    public function Device()
    {
        return $this->belongsTo(Device::class);
    }
}
