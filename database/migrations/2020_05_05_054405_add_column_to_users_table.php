<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('dzongkhag_id')->after('name')->nullable()->constrained()->references('id')->on('tbl_dzongkhags')->onDelete('cascade');
            $table->foreignId('gewog_id')->after('dzongkhag_id')->nullable()->constrained()->references('id')->on('tbl_gewogs')->onDelete('cascade');
            $table->foreignId('role_id')->after('gewog_id')->nullable()->constrained()->references('id')->on('tbl_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_dzongkhag_id_foreign');
            $table->dropForeign('users_gewog_id_foreign');
            $table->dropForeign('users_role_id_foreign');
            $table->dropIndex('users_dzongkhag_id_foreign');
            $table->dropIndex('users_gewog_id_foreign');
            $table->dropIndex('users_role_id_foreign');
            $table->dropColumn('dzongkhag_id','gewog_id','role_id');
        });
    }
}
