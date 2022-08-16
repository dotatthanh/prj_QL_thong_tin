<?php

namespace App\Imports;

use DB;
use App\Models\Device;
use App\Models\TransmissionStream;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use DateTime;

class TransmissionStreamImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
	use Importable, SkipsErrors, SkipsFailures;
    // use SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public $data;

    public function model(array $row)
    {
        try {
            DB::beginTransaction();
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

            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
    
    public function collection(Collection $rows)
    {
        $this->data = $rows;
    }


    public function rules(): array
    {
        return [
            '*.device_id' => 'required|min:1',
    //         '*.code' => 'required',
    //         '*.name' => 'required|string|max:255',
    //         '*.period' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
    //         'name.string' => 'Tên khách hàng không được chứa các ký tự đặc biệt.',
    //         'name.max' => 'Tên khách hàng không được phép quá 255 ký tự.',
    //         'name.required' => 'Tên khách hàng là trường bắt buộc.',
    //         'code.required' => 'Mã khách hàng là trường bắt buộc.',
    //         'period.required' => 'Kỳ thu là trường bắt buộc.',
            'device_id.required' => 'Số điện là trường bắt buộc.',
            'device_id.min' => 'Số điện ít nhất phải bằng 1.',
        ];
    }
}
