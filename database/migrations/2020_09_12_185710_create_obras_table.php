<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_solicito_id')->unsigned();
            $table->integer('usuario_aprobo_id')->unsigned()->nullable();
            $table->integer('usuario_rechazo_id')->unsigned()->nullable();

            // Datos generales de identificacion
            $table->integer('tipo_objeto_id')->unsigned();
            $table->integer('tipo_bien_cultural_id')->unsigned();
            $table->integer('epoca_id')->unsigned()->nullable();
            $table->integer('temporalidad_id')->unsigned()->nullable();
            $table->integer('area_id')->unsigned()->nullable();
            $table->integer('usuario_recibio_id')->unsigned()->nullable()->comment("Usuario que realizó la entrada");
            $table->integer('usuario_entrego_id')->unsigned()->nullable()->comment("Usuario que realizó la salida");
            $table->integer('proyecto_id')->unsigned()->nullable();

            $table->text('seo');
            $table->string('nombre')->index();
            $table->string('autor')->index()->nullable();
            $table->string('cultura')->index()->nullable();
            $table->string('lugar_procedencia_actual');
            $table->string('numero_inventario');
            $table->date('año')->nullable();
            $table->enum('estatus_año', config('valores.status_años_obras'))->nullable();
            $table->enum('estatus_epoca', config('valores.status_años_obras'))->nullable();
            $table->decimal('alto', 8, 2)->unsigned();
            $table->decimal('diametro', 8, 2)->unsigned()->nullable();
            $table->decimal('profundidad', 8, 2)->unsigned()->nullable();
            $table->decimal('ancho', 8, 2)->unsigned();

            $table->datetime('fecha_ingreso')->nullable();
            $table->string('persona_entrego')->nullable()->comment("Persona que entrego a la ECRO");
            $table->string('persona_recibio')->nullable()->comment("Persona que recibio cuando salio");
            $table->string('fecha_salida')->nullable();
            $table->string('modalidad')->nullable();
            $table->text('caracteristicas_descriptivas')->nullable();
            $table->string('lugar_procedencia_original')->nullable();
            $table->enum('forma_ingreso', config('valores.obras_formas_ingreso'))->default(config('valores.obras_formas_ingreso')[0]);
            $table->enum('status_operativo', config('valores.status_operativos'))->default(config('valores.status_operativos')[0]);

            $table->datetime('fecha_aprobacion')->nullable();
            $table->datetime('fecha_rechazo')->nullable();
            $table->text('tags')->nullable();

            $table->tinyInteger('disponible_consulta')->unsigned()->default(1);

            $table->timestamps();

            $table->foreign('usuario_solicito_id')->references('id')->on('users');
            $table->foreign('usuario_aprobo_id')->references('id')->on('users');
            $table->foreign('usuario_rechazo_id')->references('id')->on('users');
            $table->foreign('usuario_recibio_id')->references('id')->on('users');
            $table->foreign('usuario_entrego_id')->references('id')->on('users');
            $table->foreign('tipo_objeto_id')->references('id')->on('obras__tipo_objeto');
            $table->foreign('tipo_bien_cultural_id')->references('id')->on('obras__tipo_bien_cultural');
            $table->foreign('epoca_id')->references('id')->on('obras__epoca');
            $table->foreign('temporalidad_id')->references('id')->on('obras__temporalidad');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras');
    }
}