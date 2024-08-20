<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->unsignedBigInteger('updated_by')->nullable()->after('updated_at');
        $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['updated_by']);
        $table->dropColumn('updated_by');
    });
}
public function updatedBy()
{
    return $this->belongsTo(User::class, 'updated_by');
}

};
