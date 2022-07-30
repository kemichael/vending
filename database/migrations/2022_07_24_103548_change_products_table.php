<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false)->change();
            $table->integer('company_id')->nullable()->change();
            $table->string('product_name')->nullable()->change();
            $table->integer('price')->nullable()->change();
            $table->integer("stock")->nullable()->change();
            $table->text('comment')->nullable()->change();
            $table->string('img_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false)->change();
            $table->integer('company_id')->nullable(false)->change();
            $table->string('product_name')->nullable(false)->change();
            $table->integer('price')->nullable(false)->change();
            $table->integer("stock")->nullable(false)->change();
            $table->text('comment')->nullable(false)->change();
            $table->string('img_path')->nullable(false)->change();
        });
    }
}
