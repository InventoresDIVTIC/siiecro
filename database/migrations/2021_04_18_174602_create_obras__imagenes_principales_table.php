<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasImagenesPrincipalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__imagenes_principales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('obra_id')->unsigned();
            $table->string('imagen_grande')->nullable();
            $table->string('imagen_chica')->nullable();
            $table->timestamps();
            $table->foreign('obra_id', 'imagen_obra_id_foreign')->references('id')->on('obras');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__imagenes_principales');
    }
}
