<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogle2faToWebuserTable extends Migration
{
    public function up()
    {
        Schema::table('webuser', function (Blueprint $table) {
            $table->string('google_id')->nullable()->after('usertype');
            $table->boolean('google_2fa_enabled')->default(false)->after('google_id');
        });
    }

    public function down()
    {
        Schema::table('webuser', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'google_2fa_enabled']);
        });
    }
}
