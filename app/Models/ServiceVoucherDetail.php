<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceVoucherDetail extends Model
{
    use HasFactory;

    protected $fillable = [
    	'service_voucher_id',
    	'date',
    	'result',
    ];

    public function serviceVoucher()
    {
        return $this->belongsTo(ServiceVoucher::class);
    }
}
