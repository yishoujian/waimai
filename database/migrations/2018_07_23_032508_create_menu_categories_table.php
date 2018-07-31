<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->increments('id')->comment("菜品分类id");
            $table->string("name")->comment("菜品分类名称");
            $table->string("type_accumulation")->comment("菜品编号");
            $table->integer("shop_id")->comment("所属店铺id");
            $table->string("description")->comment("菜品分类描述");
            $table->string("is_selected")->comment("是否是默认分类");

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
        Schema::dropIfExists('menu_categories');
    }
}
