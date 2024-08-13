<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            if (!Schema::hasColumn('sessions', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('payload');
            }
            if (!Schema::hasColumn('sessions', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('ip_address');
            }
            if (!Schema::hasColumn('sessions', 'user_id')) {
                $table->unsignedInteger('user_id')->nullable()->after('user_agent');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            if (Schema::hasColumn('sessions', 'ip_address')) {
                $table->dropColumn('ip_address');
            }
            if (Schema::hasColumn('sessions', 'user_agent')) {
                $table->dropColumn('user_agent');
            }
            if (Schema::hasColumn('sessions', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
}
