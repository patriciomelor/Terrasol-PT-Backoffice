<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueToArticleCharacteristicTable extends Migration
{
    public function up()
    {
        Schema::table('article_characteristic', function (Blueprint $table) {
            $table->string('value')->nullable()->after('characteristic_id');
        });
    }

    public function down()
    {
        Schema::table('article_characteristic', function (Blueprint $table) {
            $table->dropColumn('value');
        });
    }
}
