<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_streams', function (Blueprint $table) {
            $table->id();
            $table->integer('device_id')->comment('[Toạ độ truyền dẫn tại trạm]: Thiết bị');
            $table->string('name_card')->comment('[Toạ độ truyền dẫn tại trạm]: Tên card');
            $table->string('coordinates_origin')->comment('[Toạ độ truyền dẫn tại trạm]: Toạ độ');
            $table->integer('port_origin')->comment('[Toạ độ truyền dẫn tại trạm]: Port');
            $table->string('thread_label')->nullable()->comment('Nhãn luồng');
            $table->string('service')->nullable()->comment('Dịch vụ');
            $table->string('signal_type')->comment('Loại tín hiệu');

            $table->string('device_station')->nullable()->comment('[Truyền dẫn tại trạm]: Thiết bị');
            $table->string('coordinates_station')->nullable()->comment('[Truyền dẫn tại trạm]: Toạ độ');
            $table->string('port_station')->nullable()->comment('[Truyền dẫn tại trạm]: Port');
            
            $table->string('station')->nullable()->comment('[Toạ độ truyền dẫn đầu xa]: Trạm');
            $table->string('device')->nullable()->comment('[Toạ độ truyền dẫn đầu xa]: Thiết bị');
            $table->string('coordinates_remote')->nullable()->comment('[Toạ độ truyền dẫn đầu xa]: Toạ độ');
            $table->integer('port_remote')->nullable()->comment('[Toạ độ truyền dẫn đầu xa]: Port');
            $table->string('note')->nullable()->comment('ghi chú');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tv_streams');
    }
}
