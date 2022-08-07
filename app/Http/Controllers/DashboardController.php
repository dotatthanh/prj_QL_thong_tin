<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransmissionStream;
use App\Models\TvStream;
use App\Models\Station;
use App\Models\Device;
use App\Models\Unit;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stations = Station::all();
        $devices = Device::all();

        $data = [
            'stations' => $stations,
            'devices' => $devices,
        ];

    	return view('dashboard.dashboard', $data);
    }

    public function search(Request $request)
    {
        $transmission_streams = TransmissionStream::query();
        $tv_streams = TvStream::query();

        if (isset($request->station_id)) {
            $station = Station::find($request->station_id);
            $transmission_streams = $transmission_streams->where('station_id', $request->station_id);
            $tv_streams = $tv_streams->where('station_id', $request->station_id);
        }
        else {
            $station = Station::find(0);
        }

        if (isset($request->device_id)) {
            $transmission_streams = $transmission_streams->where('device_id', $request->device_id);
            $tv_streams = $tv_streams->where('device_id', $request->device_id);
        }

        if (isset($request->name_card)) {
            $transmission_streams = $transmission_streams->where('name_card', 'like', '%'.$request->name_card.'%');
            $tv_streams = $tv_streams->where('name_card', 'like', '%'.$request->name_card.'%');
        }

        if (isset($request->coordinates_origin)) {
            $transmission_streams = $transmission_streams->where('coordinates_origin', 'like', '%'.$request->coordinates_origin.'%');
            $tv_streams = $tv_streams->where('coordinates_origin', 'like', '%'.$request->coordinates_origin.'%');
        }

        if (isset($request->port_origin)) {
            $transmission_streams = $transmission_streams->where('port_origin', $request->port_origin);
            $tv_streams = $tv_streams->where('port_origin', $request->port_origin);
        }

        if (isset($request->thread_label)) {
            $transmission_streams = $transmission_streams->where('thread_label', 'like', '%'.$request->thread_label.'%');
            $tv_streams = $tv_streams->where('thread_label', 'like', '%'.$request->thread_label.'%');
        }

        $transmission_streams = $transmission_streams->get();
        $tv_streams = $tv_streams->get();

        $data = [
            'station' => $station,
            'tv_streams' => $tv_streams,
            'transmission_streams' => $transmission_streams,
        ];

        return view('dashboard.search', $data);
    }

    public function statistic()
    {
        $units = Unit::getTreeUnit([auth()->user()->unit_id])->pluck('id')->toArray();
        $stations = Station::whereIn('unit_id', $units)->paginate(10);

        // $stations = Station::with('tranmissionStream', 'tvStream')->paginate(10);
        
        $data = [
            'stations' => $stations,
        ];

        return view('dashboard.statistic', $data);
    }
}
