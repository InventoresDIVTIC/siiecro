<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTipoMaterialInfoCruzadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__tipo_material__info_cruzada', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_material_cruzada_info_id')->unsigned()->nullable();
            $table->integer('informacion_por_definir_cruzada_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('tipo_material_cruzada_info_id', 'tipo_material_cruzada_info_id_foreign')->references('id')->on('obras__tipo_material');
            $table->foreign('informacion_por_definir_cruzada_id', 'informacion_por_definir_cruzada_id_foreign')->references('id')->on('obras__tipo_material__informacion_por_definir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__tipo_material__info_cruzada');
    }
}
