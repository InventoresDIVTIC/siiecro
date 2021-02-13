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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form id="contact-form" class="contact__form " method="post" action="mail.php">
                     <!-- form message -->
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success" style="display: none" role="alert">
                                    Your message was sent successfully.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="nombre" id="nombre" type="text" class="form-control" placeholder="Nombre completo">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="correo" id="correo" type="email" class="form-control" placeholder="Correo electronico">
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="asunto" id="asunto" type="text" class="form-control" placeholder="Asunto">
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="telefono" id="telefono" type="text" class="form-control" placeholder="Número de teléfono">
                                </div>
                            </div>
                        </div>

                        <div class="form-group-2 mb-4">
                            <textarea name="mensaje" id="mensaje" class="form-control" rows="8" placeholder="Su mensaje"></textarea>
                        </div>

                        <div class="text-center">
                            <input class="btn btn-main btn-round-full" name="submit" type="submit" value="Enviar mensaje"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection