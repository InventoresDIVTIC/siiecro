@extends('layouts.landing')

@section('body')
    <div class="container mt-5" style="min-height: 80vh;">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <h2 class="mb-4">Consulta</h2>
                    <div class="divider mx-auto my-4"></div>
                    <p>Puedes realizar la consulta por cualquiera de estos 4 criterios.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 text-center pointer elemento-busqueda" data-tipo-busqueda="Tipo objeto">
                <div class="team-block">
                    <img src="{{ asset('img/landing/tipo_de_objeto.png') }}" alt=""  height="160px">

                    <div class="content">
                        <h4 class="mt-4 mb-0">Objeto</h4>
                        <p><i>Ejemplo: Escultura</i></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 text-center pointer elemento-busqueda" data-tipo-busqueda="Autor o cultura"> 
                <div class="team-block mb-5 mb-lg-0">
                    <img src="{{ asset('img/landing/autor.png') }}" alt="" height="160px">

                    <div class="content">
                        <h4 class="mt-4 mb-0">Autor o cultura</h4>
                        <p><i>Ejemplo: Villalpando</i></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 text-center pointer elemento-busqueda" data-tipo-busqueda="Material">
                <div class="team-block mb-5 mb-lg-0">
                    <img src="{{ asset('img/landing/material.png') }}" alt=""  height="160px">

                    <div class="content">
                        <h4 class="mt-4 mb-0">Material</h4>
                        <p><i>Ejemplo: Soporte</i></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 text-center pointer elemento-busqueda" data-tipo-busqueda="Técnica analítica">
                <div class="team-block mb-5 mb-lg-0">
                    <img src="{{ asset('img/landing/tecnica_analitica.png') }}" alt=""  height="160px">

                    <div class="content">
                        <h4 class="mt-4 mb-0">Técnica analítica</h4>
                        <p><i>Ejemplo: Microscopio óptico</i></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 hidden" id="div-busqueda">
            <div class="sidebar-widget search  mb-3 w-100">
                <h3>Ingresa el termino de busqueda para: <strong id="txt-busqueda"></strong></h3>
                <form action="#" class="search-form">
                    <input id="busqueda" name="busqueda" type="text" class="form-control" placeholder="Busqueda">
                    <i class="icofont-ui-search"></i>
                </form>
            </div>
        </div>

        <div class="hidden" id="div-resultados busqueda">
            <div class="row mt-5">
                <div class="col-lg-4">
                    <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                        <div class="sidebar-widget latest-post mb-3">
                            <h5>Popular Posts</h5>

                            <div class="py-2">
                                <span class="text-sm text-muted">03 Mar 2018</span>
                                <h6 class="my-2"><a href="#">Thoughtful living in los Angeles</a></h6>
                            </div>

                            <div class="py-2">
                                <span class="text-sm text-muted">03 Mar 2018</span>
                                <h6 class="my-2"><a href="#">Vivamus molestie gravida turpis.</a></h6>
                            </div>

                            <div class="py-2">
                                <span class="text-sm text-muted">03 Mar 2018</span>
                                <h6 class="my-2"><a href="#">Fusce lobortis lorem at ipsum semper sagittis</a></h6>
                            </div>
                        </div>

                        <div class="sidebar-widget category mb-3">
                            <h5 class="mb-4">Categories</h5>

                            <ul class="list-unstyled">
                              <li class="align-items-center">
                                <a href="#">Medicine</a>
                                <span>(14)</span>
                              </li>
                              <li class="align-items-center">
                                <a href="#">Equipments</a>
                                <span>(2)</span>
                              </li>
                              <li class="align-items-center">
                                <a href="#">Heart</a>
                                <span>(10)</span>
                              </li>
                              <li class="align-items-center">
                                <a href="#">Free counselling</a>
                                <span>(5)</span>
                              </li>
                              <li class="align-items-center">
                                <a href="#">Lab test</a>
                                <span>(5)</span>
                              </li>
                            </ul>
                        </div>


                        <div class="sidebar-widget tags mb-3">
                            <h5 class="mb-4">Tags</h5>

                            <a href="#">Doctors</a>
                            <a href="#">agency</a>
                            <a href="#">company</a>
                            <a href="#">medicine</a>
                            <a href="#">surgery</a>
                            <a href="#">Marketing</a>
                            <a href="#">Social Media</a>
                            <a href="#">Branding</a>
                            <a href="#">Laboratory</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="service-block mb-5">
                                <img src="images/service/service-1.jpg" alt="" class="img-fluid">
                                <div class="content">
                                    <h4 class="mt-4 mb-2 title-color">Child care</h4>
                                    <p class="mb-4">Saepe nulla praesentium eaque omnis perferendis a doloremque.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="service-block mb-5">
                                <img src="images/service/service-2.jpg" alt="" class="img-fluid">
                                <div class="content">
                                    <h4 class="mt-4 mb-2  title-color">Personal Care</h4>
                                    <p class="mb-4">Saepe nulla praesentium eaque omnis perferendis a doloremque.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="service-block mb-5">
                                <img src="images/service/service-3.jpg" alt="" class="img-fluid">
                                <div class="content">
                                    <h4 class="mt-4 mb-2 title-color">CT scan</h4>
                                    <p class="mb-4">Saepe nulla praesentium eaque omnis perferendis a doloremque.</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="service-block mb-5 mb-lg-0">
                                <img src="images/service/service-4.jpg" alt="" class="img-fluid">
                                <div class="content">
                                    <h4 class="mt-4 mb-2 title-color">Joint replacement</h4>
                                    <p class="mb-4">Saepe nulla praesentium eaque omnis perferendis a doloremque.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="service-block mb-5 mb-lg-0">
                                <img src="images/service/service-6.jpg" alt="" class="img-fluid">
                                <div class="content">
                                    <h4 class="mt-4 mb-2 title-color">Examination &amp; Diagnosis</h4>
                                    <p class="mb-4">Saepe nulla praesentium eaque omnis perferendis a doloremque.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="service-block mb-5 mb-lg-0">
                                <img src="images/service/service-8.jpg" alt="" class="img-fluid">
                                <div class="content">
                                    <h4 class="mt-4 mb-2 title-color">Alzheimer's disease</h4>
                                    <p class="mb-4">Saepe nulla praesentium eaque omnis perferendis a doloremque.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('scripts/landing/consulta.js') !!}
@endsection