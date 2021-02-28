@extends('layouts.landing')

@section('body')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <div class="single-blog-item">
                    <div class="col-12 text-center">
                        <img src="{{ asset('img/blog/blog-1.jpg') }}" alt="" class="img-fluid">
                    </div>

                    <div class="blog-item-content mt-5">
                        <div class="blog-item-meta mb-3">
                            <span class="text-color-2 text-capitalize mr-3"><i class="icofont-book-mark mr-2"></i> Equipment</span>
                            <span class="text-muted text-capitalize mr-3"><i class="icofont-comment mr-2"></i>5 Comments</span>
                            <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-2"></i> 28th January 2019</span>
                        </div> 

                        <h2 class="mb-4 text-md"><a href="blog-single.html">Healthy environment to care with modern equipment</a></h2>

                        <p class="lead mb-4">Non illo quas blanditiis repellendus laboriosam minima animi. Consectetur accusantium pariatur repudiandae!</p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus natus, consectetur? Illum libero vel nihil nisi quae, voluptatem, sapiente necessitatibus distinctio voluptates, iusto qui. Laboriosam autem, nam voluptate in beatae. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae iure officia nihil nemo, repudiandae itaque similique praesentium non aut nesciunt facere nulla, sequi sunt nam temporibus atque earum, ratione, labore.</p>

                        <blockquote class="quote">
                            A brand for a company is like a reputation for a person. You earn reputation by trying to do hard things well.
                        </blockquote>

                        
                        <p class="lead mb-4 font-weight-normal text-black">The same is true as we experience the emotional sensation of stress from our first instances of social rejection ridicule. We quickly learn to fear and thus automatically.</p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, rerum beatae repellat tenetur incidunt quisquam libero dolores laudantium. Nesciunt quis itaque quidem, voluptatem autem eos animi laborum iusto expedita sapiente.</p>

                        <div class="mt-5 clearfix">
                            <ul class="float-left list-inline tag-option"> 
                                <li class="list-inline-item"><a href="#">Advancher</a></li>
                                <li class="list-inline-item"><a href="#">Landscape</a></li>
                                <li class="list-inline-item"><a href="#">Travel</a></li>
                            </ul>        

                            <ul class="float-right list-inline">
                                <li class="list-inline-item"> Share: </li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-facebook" aria-hidden="true"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-twitter" aria-hidden="true"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-pinterest" aria-hidden="true"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
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