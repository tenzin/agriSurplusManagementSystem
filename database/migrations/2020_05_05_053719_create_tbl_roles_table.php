<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_roles', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->timestamps();

        });

        Schema::create('permission_role', function (Blueprint $table) {
          $table->Biginteger('permission_id')->unsigned();
          $table->Biginteger('role_id')->unsigned();
          $table->foreign('permission_id')
          ->references('id')
          ->on('tbl_permissions')
          ->onDelete('cascade');
          $table->foreign('role_id')
          ->references('id')
          ->on('tbl_roles')
          ->onDelete('cascade');
          $table->primary(['permission_id','role_id']);


      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_roles');
    }
}
