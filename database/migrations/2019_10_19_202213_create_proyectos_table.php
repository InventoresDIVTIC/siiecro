<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_id')->unsigned();
            $table->string('nombre');
            $table->string('seo');
            $table->enum('forma_ingreso', config('valores.obras_formas_ingreso'));
            $table->enum('status', config('valores.status_abierto_cerrado'));
            $table->timestamps();
            
            $table->foreign('area_id')->references('id')->on('areas');
        });

        DB::statement('ALTER TABLE proyectos ADD UNIQUE nombre_forma_ingreso_proyecto_unique(nombre, forma_ingreso);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
