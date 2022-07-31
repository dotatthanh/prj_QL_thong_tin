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

    public function tranmissionStream()
    {
        return $this->hasMany(TransmissionStream::class);
    }

    public function getTranmissionStreamUsedAttribute()
    {
        return $this->tranmissionStream->where('thread_label', '!=', NULL)->count();
    }

    public function tvStream()
    {
        return $this->hasMany(TvStream::class);
    }

    public function getTvStreamUsedAttribute()
    {
        return $this->tvStream->where('thread_label', '!=', NULL)->count();
    }
}
