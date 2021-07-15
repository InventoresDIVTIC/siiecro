<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTipoMaterialTesaurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__tipo_material_tesauros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_material_id')->unsigned();
            $table->string('nombre')->nullable();
            $table->timestamps();

            $table->foreign('tipo_material_id', 'tipo_material_id_tesauro_foreign')->references('id')->on('obras__tipo_material');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__tipo_material_tesauros');
    }
}
