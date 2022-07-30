<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CahangeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->bigIncrements('product_id') -> nullable() -> change();
            $table->integer('company_id') -> nullable() -> change();
            $table->string('product_name') -> nullable() -> change();
            $table->integer('price') -> nullable() -> change();
            $table->integer("stock") -> nullable() -> change();
            $table->text('comment') -> nullable() -> change();
            $table->string('img_path') -> nullable() -> change();
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
            //
        });
    }
}
