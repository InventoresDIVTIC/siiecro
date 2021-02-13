@extends('layouts.landing')

@section('body')
    <section class="banner" style="background: url({{ asset('img/landing/banner.jpg') }}) no-repeat; background-position: center;">
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

@endsection