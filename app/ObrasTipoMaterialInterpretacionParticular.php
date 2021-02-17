<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Interpretación particular se renombra por interpretación material 
// solo en las etiquetas visibles para el usuario del sistema, ya que 
// realizar el cambio a nivel de estructura del código y base de datos es extenso
class ObrasTipoMaterialInterpretacionParticular extends Model
{
    protected $table = 'obras__tipo_material__interpretacion_particular';
    protected $fillable = [
    	'id',
    	'nombre',
    ];
}
