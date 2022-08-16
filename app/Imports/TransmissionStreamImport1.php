<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TransmissionStreamImport1 implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        try {
            DB::beginTransaction();
            foreach ($collection as $row) {
        dd($row);
	            $device = Device::find($row['device_id']);
	            if ($device) {
	                $create = TransmissionStream::create([
	                    'station_id' => $device->station->id,
	                    'device_id' => $device->id,
	                    'name_card' => $row['name_card'],
	                    'port_origin' => $row['port_origin'],
	                    'coordinates_origin' => $row['coordinates_origin'],
	                    // 'signal_type' => $row['signal_type'],
	                    // 'thread_label' => $row['thread_label'],
	                    // 'service' => $row['service'],
	                    // 'station' => $row['station'],
	                    // 'device' => $row['device'],
	                    // 'coordinates_remote' => $row['coordinates_remote'],
	                    // 'port_remote' => $row['port_remote'],
	                    // 'note' => $row['note'],
	                ]);
	            }
            }
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
