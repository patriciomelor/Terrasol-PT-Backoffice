<?php

// database/migrations/xxxx_xx_xx_create_characteristics_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable(); // Ruta al icono
            $table->timestamps();
        });

        // Tabla pivote para la relación muchos a muchos
        Schema::create('article_characteristic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->foreignId('characteristic_id')->constrained()->onDelete('cascade');
            $table->string('icon')->nullable(); // Asegúrate de que este campo exista
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('article_characteristic');
        Schema::dropIfExists('characteristics');
    }
};
