<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblExSurplusHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ex_surplus_history', function (Blueprint $table) {
            $table->id();
            $table->string('refNumber', 12);
            $table->foreignId('productType_id')->constrained()->references('id')->on('tbl_product_types')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->references('id')->on('tbl_products')->onDelete('cascade');
            $table->float('quantity');
            $table->foreignId('unit_id')->constrained()->references('id')->on('tbl_units')->onDelete('cascade');
            $table->float('price');
            $table->foreignId('dzongkhag_id')->nullable()->constrained()->references('id')->on('tbl_dzongkhags')->onDelete('cascade');
            $table->foreignId('gewog_id')->nullable()->constrained()->references('id')->on('tbl_gewogs')->onDelete('cascade');
            $table->char('status', 1);
            $table->longText('remarks')->nullable();
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
        Schema::dropIfExists('tbl_ex_surplus_history');
    }
}
