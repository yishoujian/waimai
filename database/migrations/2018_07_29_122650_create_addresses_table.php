<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string("user_id")->comment("用户ID");
            $table->string("name")->comment("名字");
            $table->string("provence")->comment("省");
            $table->string("city")->comment("市");
            $table->string("area")->comment("区县");
            $table->string("detail_address")->comment("详细地址");
            $table->string("tel")->comment("手机号码");
            $table->boolean('is_default')->comment("是否默认0否 1是");
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
        Schema::dropIfExists('addresses');
    }
}
