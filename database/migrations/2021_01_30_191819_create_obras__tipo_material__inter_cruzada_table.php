<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTipoMaterialInterCruzadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__tipo_material__inter_cruzada', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_material_cruzada_iter_id')->unsigned()->nullable();
            $table->integer('interpretacion_particular_cruzada_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('tipo_material_cruzada_iter_id', 'tipo_material_cruzada_iter_id_foreign')->references('id')->on('obras__tipo_material');
            $table->foreign('interpretacion_particular_cruzada_id', 'interpretacion_particular_cruzada_id_foreign')->references('id')->on('obras__tipo_material__interpretacion_particular');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__tipo_material__inter_cruzada');
    }
}
