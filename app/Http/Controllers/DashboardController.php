<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthCertification;
use App\Models\ServiceVoucher;
use App\Models\Prescription;

class DashboardController extends Controller
{
    public function index()
    {
    	// $health_certification = HealthCertification::whereMonth('created_at', date('m'))->count();
    	// $service_voucher = ServiceVoucher::whereMonth('created_at', date('m'))->count();
    	// $prescription = Prescription::whereMonth('created_at', date('m'))->count();

    	$data = [
    		// 'health_certification' => $health_certification,
    		// 'service_voucher' => $service_voucher,
    		// 'prescription' => $prescription,
    	];

    	return view('dashboard', $data);
    }
}
