<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMonthlyQuantity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_monthly_quantity', function (Blueprint $table) {
            $table->id();
            $table->integer('productType_id');
            $table->integer('quantity');
            $table->integer('unit_id');
            $table->integer('gewog_id');
            $table->integer('dzongkhag_id');
            $table->integer('tmonth');
            $table->integer('tyear');
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
        Schema::dropIfExists('tbl_monthly_quantity');
    }
}
