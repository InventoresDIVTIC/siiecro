<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTipoMaterialInterpretacionParticularTesaurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__tipo_material__interpretacion_particular_tesauros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_material_interpretacion_particular_id')->unsigned();
            $table->string('nombre')->nullable();
            $table->timestamps();

            $table->foreign('tipo_material_interpretacion_particular_id', 'tipo_material_interpretacion_particular_id_tesauro_foreign')->references('id')->on('obras__tipo_material__interpretacion_particular');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__tipo_material__interpretacion_particular_tesauros');
    }
}
