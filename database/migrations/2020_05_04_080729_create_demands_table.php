<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->string('refNumber', 12);
            $table->unsignedBigInteger('productType_id');
            $table->unsignedBigInteger('product_id');
            $table->float('quantity');
            $table->unsignedBigInteger('unit_id');
            $table->date('tentativeRequiredDate');
            $table->float('price');
            $table->char('status', 1);
            $table->longText('remarks')->nullable()->change();
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
        Schema::dropIfExists('demands');
    }
}
