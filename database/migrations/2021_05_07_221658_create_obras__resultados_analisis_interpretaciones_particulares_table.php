<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasResultadosAnalisisInterpretacionesParticularesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__resultados_analisis_interpretaciones_particulares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('obras__resultados_analisis_id')->unsigned()->nullable();
            $table->integer('obras__tipo_material__interpretacion_particular_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('obras__resultados_analisis_id', 'obs__resultados_analisis_foreign')->references('id')->on('obras__resultados_analisis')->onDelete('cascade');
            $table->foreign('obras__tipo_material__interpretacion_particular_id', 'obs_tipmat_interpretacion_particular_foreign')->references('id')->on('obras__tipo_material__interpretacion_particular');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__resultados_analisis_interpretaciones_particulares');
    }
}
