<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDzongkhagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dzongkhags', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->unique();
            $table->string('dzongkhag')->unquie();
            $table->foreignId('region_id')->nullable()->references('id')->on('tbl_regions')->OnDelete('cascade');
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
        Schema::dropIfExists('tbl_dzongkhags');
    }
}
