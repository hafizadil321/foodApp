<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('cat_icon')->after('image')->nullable();
            $table->string('color')->after('cat_icon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('cat_icon');
            $table->dropColumn('color');
        });
    }
}
