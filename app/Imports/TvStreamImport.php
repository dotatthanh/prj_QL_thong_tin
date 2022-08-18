<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use App\Models\Device;
use App\Models\TvStream;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class TvStreamImport implements ToCollection, WithHeadingRow, WithValidation
{
	use Importable;
    /**
    * @param Collection $collection
    */

    public function  __construct($device_id)
    {
        $this->device_id = $device_id;
    }
    
    public function collection(Collection $collection)
    {
        try {
            DB::beginTransaction();

            foreach ($collection as $row) {
	            $device = Device::find($this->device_id);
	            if ($device) {
	                $create = TvStream::create([
	                    'station_id' => $device->station->id,
	                    'device_id' => $this->device_id,
	                    'name_card' => $row['ten_card'],
	                    'port_origin' => $row['port_tai_tram'],
	                    'signal_type' => $row['loai_tin_hieu'],
	                    'coordinates_origin' => $row['toa_do_tai_tram'],
	                    'thread_label' => $row['nhan_luong'],
	                    'service' => $row['dich_vu'],
	                    'station' => $row['tram'],
	                    'device' => $row['thiet_bi_truyen_dan'],
	                    'coordinates_remote' => $row['toa_do_truyen_dan'],
	                    'port_remote' => $row['port_truyen_dan'],
	                    'note' => $row['ghi_chu'],
	                    'port_station' => $row['port_dau_xa'],
	                    'coordinates_station' => $row['toa_do_dau_xa'],
	                    'device_station' => $row['thiet_bi_dau_xa'],
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
        	'*.ten_card' => 'required',
        	'*.port_tai_tram' => 'required|numeric',
        	'*.toa_do_tai_tram' => 'required',
        	'*.loai_tin_hieu' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'ten_card.required' => 'Tên card là trường bắt buộc.',
            'toa_do_tai_tram.required' => 'Toạ độ là trường bắt buộc.',
            'port_tai_tram.required' => 'Port là trường bắt buộc.',
            'port_tai_tram.numeric' => 'Port phải là định dạng số.',
            'signal_type.required' => 'Loại tín hiệu là trường bắt buộc.',
        ];
    }
}
