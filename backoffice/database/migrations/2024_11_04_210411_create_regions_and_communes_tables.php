<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('regiones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->timestamps();
        });
    
        Schema::create('comunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('regiones')->onDelete('cascade');
            $table->string('nombre');
            $table->timestamps();
        });
    }
    
};
