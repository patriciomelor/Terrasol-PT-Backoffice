<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class InsertRolesIntoRolesTable extends Migration
{
    public function up()
    {
        $roles = [
            ['name' => 'Administrator', 'guard_name' => 'web'],
            ['name' => 'Editor', 'guard_name' => 'web'],
            ['name' => 'Author', 'guard_name' => 'web'],
            ['name' => 'Contributor', 'guard_name' => 'web'],
            ['name' => 'Subscriber', 'guard_name' => 'web'],
        ];

        DB::table('roles')->insert($roles);
    }

    public function down()
    {
        // Opcional: código para revertir la inserción si es necesario
        DB::table('roles')->whereIn('name', ['Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber'])->delete();
    }
}
