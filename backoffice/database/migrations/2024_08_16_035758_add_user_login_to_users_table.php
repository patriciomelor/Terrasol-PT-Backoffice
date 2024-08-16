<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'user_login')) {
                $table->string('user_login')->default('default_value');
            }
        });
    }

    public function down() {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'user_login')) {
                $table->dropColumn('user_login');
            }
        });
    }
};
