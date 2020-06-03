<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUnitProductMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_unit_product_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->references('id')->on('tbl_products')->onDelete('cascade');
            $table->foreignId('unit_id')->nullable()->constrained()->references('id')->on('tbl_units')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_unit_product_mappings');
    }
}
