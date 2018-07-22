<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("用户名称");
            $table->string('password')->comment("用户密码");
            $table->string('email')->comment("用户邮箱");
            $table->string('remember_token')->comment("是否记住");
            $table->integer('stutas')->comment("状态");
            $table->integer('shop_id')->comment("所属商家");
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
        Schema::dropIfExists('users');
    }
}
