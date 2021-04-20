@extends('layouts.landing')

@section('body')
    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <span class="text-white">Contáctanos</span>
                        <h1 class="text-capitalize mb-5 text-lg">Solicita acceso</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-form-wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h2 class="text-md mb-2">¿Necesitas contactarnos?</h2>
                        <div class="divider mx-auto my-4"></div>
                        <p class="mb-5">Solicita tu cuenta para poder realizar consultas a través de nuestro sistema.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" id="div-principal">
                    {!! Form::open(['route' => ['contacto.contacto'], 'method' => 'PUT', 'id' => 'form-contacto', 'class' => 'contact__form']) !!}
                        <div class="row hidden" id="carga-contacto">
                            <div class="col-12">
                                <div class="spinner-border pull-right" role="status" aria-hidden="true"></div>
                            </div>
                        </div>
                        

                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="nombre" id="nombre" type="text" class="form-control" placeholder="Nombre completo" autocomplete="off" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="correo" id="correo" type="email" class="form-control" placeholder="Correo electronico" autocomplete="off" required="">
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="asunto" id="asunto" type="text" class="form-control" placeholder="Asunto" autocomplete="off" required="">
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="telefono" id="telefono" type="text" class="form-control" placeholder="Número de teléfono" autocomplete="off" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group-2 mb-4">
                            <textarea name="mensaje" id="mensaje" class="form-control" rows="8" placeholder="Su mensaje" autocomplete="off" required=""></textarea>
                        </div>

                        <div class="text-center">
                            <input class="btn btn-main btn-round-full" name="submit" type="submit" value="Enviar mensaje"></input>
                        </div>
                    {!! Form::close() !!}
                </div>

                <div id="div-error">
                    
                </div>

                <div class="col-12 hidden" id="div-exito">
                    <div class="alert alert-success" role="alert">
                        Mensaje enviado exitosamente.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    {!! Html::script('scripts/landing/contacto.js') !!}
@endsection