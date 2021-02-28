<div class="row mt-5">
    <div class="col-lg-3">
        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
            <div class="sidebar-widget category mb-2 pb-0">
                <h5 class="mb-2">Año</h5>

                <div class="form-group">
                    <select class="form-control" id="">
                      <option>2007</option>
                      <option>2008</option>
                    </select>
                </div>

            </div>
        </div>
        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
            <div class="sidebar-widget category mb-2 pb-0">
                <h5 class="mb-2">Época</h5>

                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Siglo XXI</option>
                      <option>Siglo XX</option>
                      <option>Siglo XIX</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
            <div class="sidebar-widget category mb-2 pb-0">
                <h5 class="mb-2">Temporalidad</h5>

                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Desconocida</option>
                      <option>Clásico temprano (0-300 d.C)</option>
                      <option>Preclásico medio</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
            <div class="sidebar-widget category mb-2 pb-0">
                <h5 class="mb-2">Autor o Cultura</h5>

                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Mario Rosilio</option>
                      <option>Tamara de Lempicka</option>
                      <option>Capacha, Occidente de México</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
            <div class="sidebar-widget category mb-2 pb-0">
                <h5 class="mb-2">Lugar de procedencia actual</h5>

                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Museo de Mascota</option>
                      <option>Museo Regional de Guadalajara</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
            <div class="sidebar-widget category mb-2 pb-0">
                <h5 class="mb-2">Lugar de procedencia original</h5>

                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Desconocido</option>
                      <option>"El Panteon" Mascota, Jalisco</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
            <div class="sidebar-widget tags mb-2 pb-0">
                <h5 class="mb-2">Tipo de bien cultural</h5>

                <a href="#">Etnográfico</a>
                <a href="#">Industrial</a>
                <a href="#">Religioso</a>
                <a href="#">Artístico</a>
                <a href="#">Histórico</a>
            </div>
        </div>
        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
            <div class="sidebar-widget tags mb-2 pb-0">
                <h5 class="mb-2">Materiales</h5>

                <a href="#">Sal</a>
                <a href="#">Adhesivo</a>
                <a href="#">Capas de superficie </a>
                <a href="#">Aglutinante</a>
                <a href="#">Colorante</a>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Área</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Responsable ECRO</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Proyecto ECRO</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Año de la temporada de trabajo</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">

            @for ($i = 1; $i < 6; $i++)
                <div class="col-12">
                    <a href="{{ route('consulta.detalle', "obra-1") }}">
                        <div class="service-block mb-2 mt-0">
                            <img src="images/service/service-1.jpg" alt="" class="img-fluid">
                            <div class="content">
                                <h4 class="mt-4 mb-2 title-color">Obra {{ $i }}</h4>
                                <p class="mb-4">Contenido</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endfor

        </div>
    </div>
</div>