@extends('layouts.landing')

@section('body')
    <section class="banner" style="background: url({{ asset('img/landing/back.jpg') }}) no-repeat; background-position: 0 -807px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-xl-7">
                    <div class="block">
                        <div class="divider mb-3"></div>
                        <span class="text-uppercase text-sm letter-spacing ">Total Health care solution</span>
                        <h1 class="mb-3 mt-3">Your most trusted health partner</h1>
                        
                        <p class="mb-4 pr-5">A repudiandae ipsam labore ipsa voluptatum quidem quae laudantium quisquam aperiam maiores sunt fugit, deserunt rem suscipit placeat.</p>
                        <div class="btn-container ">
                            <a href="appoinment.html" target="_blank" class="btn btn-main-2 btn-icon btn-round-full">Make appoinment <i class="icofont-simple-right ml-2  "></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section about">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-12 text-center">
                    <h3>Espacio de resguardo, administración y consulta de la información más relevante de las obras intervenidas en los diferentes Seminarios Taller de Restauración de la ECRO con la finalidad de impulsar la salvaguarda de los datos y su investigación.</h3>
                </div>
            </div>
            <div class="divider mx-auto my-4"></div>
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-6">
                    <div class="about-img">
                        <img src="{{ asset('img/landing/2.jpg') }}" alt="" class="img-fluid">
                        <img src="{{ asset('img/landing/3.jpg') }}" alt="" class="img-fluid mt-4">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="about-img mt-4 mt-lg-0">
                        <img src="{{ asset('img/landing/4.jpg') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    {!! Html::script('scripts/dashboard/areas.js') !!}
@endsection