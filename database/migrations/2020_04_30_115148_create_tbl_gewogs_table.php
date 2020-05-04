<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGewogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gewogs', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->unique();
            $table->foreignId('dzongkhag_id')->constrained()->references('id')->on('tbl_dzongkhags')->onDelete('cascade');
            $table->string('gewog');
            $table->float('latitude')->nullable();
            $table->float('longitude')->nunable();
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
        Schema::dropIfExists('tbl_gewogs');
    }
}
