<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'parent_id',
    ];

    public function stations()
    {
        return $this->hasMany(Station::class);
    }

    public function getParentAttribute()
    {
    	$unit = Unit::find($this->parent_id);

    	return $unit ? $unit->name : '';
    }
}
