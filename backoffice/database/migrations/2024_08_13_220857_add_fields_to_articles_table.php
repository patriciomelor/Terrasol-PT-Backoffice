<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->integer('square_meters')->nullable();
            $table->integer('constructed_meters')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('sale_or_rent')->nullable();
            $table->json('photos')->nullable(); // Si las fotos son un array
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['square_meters', 'constructed_meters', 'region', 'city', 'street', 'sale_or_rent', 'photos']);
        });
    }
};
