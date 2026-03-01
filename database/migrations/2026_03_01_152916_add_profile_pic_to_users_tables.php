<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfilePicToUsersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student', function (Blueprint $table) {
            $table->string('profile_pic')->nullable();
        });

        Schema::table('faculty', function (Blueprint $table) {
            $table->string('profile_pic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student', function (Blueprint $table) {
            $table->dropColumn('profile_pic');
        });

        Schema::table('faculty', function (Blueprint $table) {
            $table->dropColumn('profile_pic');
        });
    }
}
