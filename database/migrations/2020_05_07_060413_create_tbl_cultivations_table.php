<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCultivationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cultivations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productType_id')->constrained()->references('id')->on('tbl_product_types')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->references('id')->on('tbl_products')->onDelete('cascade');
            $table->foreignId('c_units')->constrained()->references('id')->on('tbl_cultivationunits')->onDelete('cascade');
            $table->foreignId('e_units')->constrained()->references('id')->on('tbl_units')->onDelete('cascade');
            $table->float('quantity');
            $table->date('sowing_date');
            $table->float('estimated_output');
            $table->float('actual_output')->nullable();
            $table->string('remarks')->nullable();
            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('dzongkhag_id')->nullable()->constrained()->references('id')->on('tbl_dzongkhags')->onDelete('cascade');
            $table->foreignId('gewog_id')->nullable()->constrained()->references('id')->on('tbl_gewogs')->onDelete('cascade');
            $table->integer('status');
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
        Schema::dropIfExists('tbl_cultivations');
    }
}
