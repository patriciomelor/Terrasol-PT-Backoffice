<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('secondary_color')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('address')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->text('about_us')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['secondary_color', 'contact_phone', 'contact_email', 'address', 'mission', 'vision', 'about_us']);
        });
    }
    
    
};
