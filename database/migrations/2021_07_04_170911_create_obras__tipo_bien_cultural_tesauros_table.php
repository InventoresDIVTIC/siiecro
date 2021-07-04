<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTipoBienCulturalTesaurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__tipo_bien_cultural_tesauros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_bien_cultural_id')->unsigned();
            $table->string('nombre')->nullable();
            $table->timestamps();

            $table->foreign('tipo_bien_cultural_id', 'tipo_bien_cultural_id_tesauro_foreign')->references('id')->on('obras__tipo_bien_cultural');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__tipo_bien_cultural_tesauros');
    }
}
