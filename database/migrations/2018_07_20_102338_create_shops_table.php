<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shopategrop_id')->comment("店铺分类ID");
            $table->string('name')->comment("店铺名称");
            $table->string('shop_logo')->comment("店铺图片");
            $table->integer('shop_rating')->comment("店铺评分");
            $table->boolean('brand')->comment("是否品牌");
            $table->boolean('on_time')->comment("是否准时");
            $table->boolean('fengniao')->comment("是否蜂鸟配送");
            $table->boolean('bao')->comment("是否保标记");
            $table->boolean('piao')->comment("是否票标记");
            $table->boolean('zhun')->comment("是否准标记");
            $table->decimal('start_send')->comment("起送金额");
            $table->decimal('send_cost')->comment("配送金额");
            $table->string('notice')->comment("店公告");
            $table->string('discount')->comment("店优惠");
            $table->integer('status')->comment("状态");



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
        Schema::dropIfExists('shops');
    }
}
