<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use App\Models\Device;
use App\Models\TransmissionStream;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;

class TransmissionStreamImport implements ToCollection, WithHeadingRow, WithValidation
{
	use Importable;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        try {
            DB::beginTransaction();

            foreach ($collection as $row) {
	            $device = Device::find($row['device_id']);
	            if ($device) {
	                $create = TransmissionStream::create([
	                    'station_id' => $device->station->id,
	                    'device_id' => $device->id,
	                    'name_card' => $row['name_card'],
	                    'port_origin' => $row['port_origin'],
	                    'coordinates_origin' => $row['coordinates_origin'],
	                    'signal_type' => $row['signal_type'],
	                    'thread_label' => $row['thread_label'],
	                    'service' => $row['service'],
	                    'station' => $row['station'],
	                    'device' => $row['device'],
	                    'coordinates_remote' => $row['coordinates_remote'],
	                    'port_remote' => $row['port_remote'],
	                    'note' => $row['note'],
	                ]);
	            }
            }
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function rules(): array
    {
        return [
        	'*.device_id' => 'required',
        	'*.name_card' => 'required',
        	'*.port_origin' => 'required|numeric',
        	'*.coordinates_origin' => 'required',
        	'*.signal_type' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'device_id.required' => 'ID thiết bị là trường bắt buộc.',
            'name_card.required' => 'Tên card là trường bắt buộc.',
            'coordinates_origin.required' => 'Toạ độ là trường bắt buộc.',
            'port_origin.required' => 'Port là trường bắt buộc.',
            'port_origin.numeric' => 'Port phải là định dạng số.',
            'signal_type.required' => 'Loại tín hiệu là trường bắt buộc.',
        ];
    }
}
