<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="css/bootstrap4.0.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
    </style>
</head>
<body>
    <table class="table table-bordered table-centered table-nowrap">
        <thead class="thead-light">
            <tr>
                <th rowspan="2" class="text-center">STT</th>
                <th colspan="4" class="text-center">Toạ độ truyền dẫn tại trạm</th>
                <th rowspan="2">Nhãn luồng</th>
                <th rowspan="2">Dịch vụ</th>
                <th rowspan="2">Loại tín hiệu</th>
                <th colspan="4" class="text-center">Toạ độ truyền dẫn đầu xa</th>
                <th rowspan="2">Ghi chú</th>
                <th rowspan="2">Ngày cập nhật</th>
            </tr>
            <tr>
                <th>Thiết bị</th>
                <th>Tên card</th>
                <th>Toạ độ</th>
                <th>Port</th>
                <th>Trạm</th>
                <th>Thiết bị</th>
                <th>Toạ độ</th>
                <th>Port</th>
            </tr>
        </thead>
        <tbody>
            @php ($stt = 1)
            @foreach ($transmission_streams as $transmission_stream)
                <tr>
                    <td class="text-center">{{ $stt++ }}</td>
                    <td>
                        {{ $transmission_stream->Device->name }}
                    </td>
                    <td>{{ $transmission_stream->name_card }}</td>
                    <td>{{ $transmission_stream->coordinates_origin }}</td>
                    <td>{{ $transmission_stream->port_origin }}</td>
                    <td>{{ $transmission_stream->thread_label }}</td>
                    <td>{{ $transmission_stream->service }}</td>
                    <td>{{ $transmission_stream->signal_type }}</td>
                    <td>{{ $transmission_stream->station }}</td>
                    <td>{{ $transmission_stream->device }}</td>
                    <td>{{ $transmission_stream->coordinates_remote }}</td>
                    <td>{{ $transmission_stream->port_remote }}</td>
                    <td>{{ $transmission_stream->note }}</td>
                    <td>{{ date('d/m/Y', strtotime($transmission_stream->updated_at)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>