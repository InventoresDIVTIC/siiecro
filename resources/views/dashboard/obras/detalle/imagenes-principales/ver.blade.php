<div id="contenedor-obra-imagenes-principales">
    <div class="owl-carousel owl-theme" id="carrusel-obra-imagenes-principales">
        @foreach ($imagenes_principales as $imagen)
            <div class="item p-r-sm p-l-sm">
                <a href="{{ asset('img/obras/imagenes-principales/'.$imagen->imagen_grande) }}" data-gallery="">
                    <img class="img-responsive" src="{{ asset('img/obras/imagenes-principales/'.$imagen->imagen_grande) }}" style="height: 150px; width: auto; margin: auto;">
                </a>
                <i onclick="eliminarImagenPrincipalDeObra({{ $imagen->id }}, {{ $imagen->obra_id }})" class="fa fa-trash texto-rojo fa-lg icono-img" aria-hidden="true" data-placement="left" mi-tooltip="Eliminar"></i>
            </div>
        @endforeach
    </div>  
</div>