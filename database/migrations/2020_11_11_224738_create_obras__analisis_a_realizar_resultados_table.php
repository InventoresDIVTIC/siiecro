<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasAnalisisARealizarResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__analisis_a_realizar_resultados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resultado_analisis_id')->unsigned();
            $table->integer('analisis_a_realizar_id')->unsigned()->nullable();
            $table->integer('tecnica_analitica_id')->unsigned()->nullable();
            $table->integer('informacion_por_definir_id')->unsigned()->nullable();
            $table->integer('info_del_equipo_id')->unsigned()->nullable();

            $table->string('interpretacion');
            // $table->string('descripciones')->nullable();
            // $table->string('datos')->nullable();
            $table->string('ruta_acceso_imagen')->nullable();
            // $table->string('ruta_acceso_datos')->nullable();
            $table->timestamps();

            $table->foreign('resultado_analisis_id', 'resultado_analisis_id_foreign')->references('id')->on('obras__resultados_analisis')->onDelete('cascade');
            $table->foreign('analisis_a_realizar_id', 'analisis_a_realizar_resultados_id_foreign')->references('id')->on('obras__analisis_a_realizar');
            $table->foreign('tecnica_analitica_id', 'tecnica_analitica_id_foreign')->references('id')->on('obras__analisis_a_realizar_tecnica');
            $table->foreign('informacion_por_definir_id', 'informacion_por_definir_id_foreign')->references('id')->on('obras__tipo_material__informacion_por_definir');
            $table->foreign('info_del_equipo_id', 'info_del_equipo_id_foreign')->references('id')->on('obras__analisis_a_realizar_informacion_del_equipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__analisis_a_realizar_resultados');
    }
}
