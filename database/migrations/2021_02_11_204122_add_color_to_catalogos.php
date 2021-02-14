<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToCatalogos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('obras__tipo_bien_cultural', function (Blueprint $table) {
            $table->string("color_hexadecimal")->after("calcular_temporalidad");
        });

        Schema::table('obras__tipo_objeto', function (Blueprint $table) {
            $table->string("color_hexadecimal")->after("nombre");
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->string("color_hexadecimal")->after("siglas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('obras__tipo_bien_cultural', function (Blueprint $table) {
            $table->dropColumn("color_hexadecimal");
        });

        Schema::table('obras__tipo_objeto', function (Blueprint $table) {
            $table->dropColumn("color_hexadecimal");
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->dropColumn("color_hexadecimal");
        });
    }
}
