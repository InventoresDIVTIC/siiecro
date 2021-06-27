<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTipoObjetoTesauros extends Model
{
  protected $table = "obras__tipo_objeto_tesauros";
  protected $fillable = [
    'tipo_objeto_id',
    'nombre',
  ];
}
