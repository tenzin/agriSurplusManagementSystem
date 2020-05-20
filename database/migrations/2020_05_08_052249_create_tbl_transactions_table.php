<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('refNumber', 12);
            $table->char('type', 1);
            $table->date('expiryDate', 12);
            $table->char('status', 1);
            $table->string('phone',13);
            $table->string('location',100);
            $table->date('pickupdate',12)->nullable();
            $table->string('remark',100)->nullable();
            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('dzongkhag_id')->nullable()->constrained()->references('id')->on('tbl_dzongkhags')->onDelete('cascade');
            $table->foreignId('gewog_id')->nullable()->constrained()->references('id')->on('tbl_gewogs')->onDelete('cascade');
            $table->longText('remarks')->nullable()->change();
            $table->date('submittedDate')->nullable();
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
        Schema::dropIfExists('tbl_transactions');
    }
}
