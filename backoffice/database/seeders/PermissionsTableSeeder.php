<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Asegúrate de importar la clase DB

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'edit_posts'],
            ['name' => 'copy_posts'],
            ['name' => 'delete_posts'],
            // Agrega más permisos según sea necesario
        ]);
    }
}
