<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'secondary_color')) {
                $table->string('secondary_color')->nullable();
            }
            if (!Schema::hasColumn('settings', 'contact_phone')) {
                $table->string('contact_phone')->nullable();
            }
            if (!Schema::hasColumn('settings', 'contact_email')) {
                $table->string('contact_email')->nullable();
            }
            if (!Schema::hasColumn('settings', 'address')) {
                $table->string('address')->nullable();
            }
            if (!Schema::hasColumn('settings', 'mission')) {
                $table->text('mission')->nullable();
            }
            if (!Schema::hasColumn('settings', 'vision')) {
                $table->text('vision')->nullable();
            }
            if (!Schema::hasColumn('settings', 'about_us')) {
                $table->text('about_us')->nullable();
            }
        });
    }
    
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['secondary_color', 'contact_phone', 'contact_email', 'address', 'mission', 'vision', 'about_us']);
        });
    }
    
    
    
};
