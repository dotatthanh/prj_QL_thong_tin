<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
    	'code',
    	'name',
    	'description',
    	'price',
    	'type_id',
    	'unit',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function prescriptionDetails()
    {
        return $this->hasMany(PrescriptionDetail::class);
    }
}
