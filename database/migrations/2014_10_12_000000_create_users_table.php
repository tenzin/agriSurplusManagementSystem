<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('cid')->nullable();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->Boolean('isActive')->nullable();
            $table->Boolean('isAdmin')->nullable();
            $table->Boolean('isStaff')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('avatar')->default('images/avatar04.png')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nunable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
