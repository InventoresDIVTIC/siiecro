<!DOCTYPE html>
<html lang="zxx">
	<head>
 		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	  	<title>SII-ECRO</title>

	  	<!-- Favicon -->
	  	<link rel="icon" href="img/favicon.ico" type="image/x-icon">

	  	<!-- bootstrap.min css -->
	  	{!!Html::style('landing/plugins/bootstrap/css/bootstrap.min.css')!!}
	  	<!-- Icon Font Css -->
	  	{!!Html::style('landing/plugins/icofont/icofont.min.css')!!}
	  	<!-- Slick Slider  CSS -->
	  	{!!Html::style('landing/plugins/slick-carousel/slick/slick.css')!!}
	  	{!!Html::style('landing/plugins/slick-carousel/slick/slick-theme.css')!!}

	  	<!-- Main Stylesheet -->
	  	{!!Html::style('landing/css/style.css')!!}

	</head>

	<body id="top">

		<header>
			<nav class="navbar navbar-expand-lg navigation color-navbar" id="navbar">
				<div class="container">
				 	 <a href="index.html">
					  	<img src="{{ asset('/img/sii-ecro.png') }}" alt="" class="img-fluid" style="height: 65px;">
					  </a>

				  	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icofont-navigation-menu"></span>
				  </button>
			  
				  <div class="collapse navbar-collapse" id="navbarmain">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="{{ route('landing.index') }}">Inicio</a>
					  	</li>
					  	<li class="nav-item active">
							<a class="nav-link" href="{{ route('consulta.index') }}">Consulta</a>
					  	</li>
					  	<li class="nav-item active">
							<a class="nav-link" href="{{ route('contacto.index') }}">Contacto</a>
					  	</li>
					</ul>
				  </div>
				</div>
			</nav>
		</header>

		<div class="main-content">
			@yield('body')
		</div>

		<!-- footer Start -->
		<footer class="footer section gray-bg pt-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 mr-auto col-sm-6">
						<div class="widget mb-5 mb-lg-0 mt-5">
							<div class="logo mb-4">
								<img src="{{ asset('/img/sii-ecro.png') }}" alt="" class="img-fluid" style="height: 80px;">
							</div>
						</div>
					</div>

					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="widget mb-5 mb-lg-0">
							<h4 class="text-capitalize mb-3">Teléfonos</h4>
							<div class="divider mb-4"></div>

							<ul class="list-unstyled footer-menu lh-35">
								<li><a href="tel:3336171409">(33) 3617-1409</a></li>
								<li><a href="tel:3336172819">(33) 3617-2819</a></li>
								<li><a href="tel:3326172741">(33) 2617-2741</a></li>
							</ul>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="widget widget-contact mb-5 mb-lg-0">
							<h4 class="text-capitalize mb-3">Contáctanos</h4>
							<div class="divider mb-4"></div>

							<div class="footer-contact-block mb-4">
								<div class="icon d-flex align-items-center">
									<i class="icofont-email mr-3"></i>
									<span class="h6 mb-0">Email</span>
								</div>
								<h4 class="mt-2"><a href="mailto:siiecro@ecro.edu.mx">siiecro@ecro.edu.mx</a></h4>
							</div>

							<div class="footer-contact-block">
								<div class="icon d-flex align-items-center">
									<i class="icofont-google-map mr-3"></i>
									<span class="h6 mb-0">Dirección</span>
								</div>
								<h4 class="mt-2">
									<a href="https://www.google.com.mx/maps/place/Escuela+de+Conservaci%C3%B3n+y+Restauraci%C3%B3n+de+Occidente/@20.6696923,-103.3423147,17z/data=!3m1!4b1!4m5!3m4!1s0x8428b1f436fa99af:0xa67d189c0bec5193!8m2!3d20.6696873!4d-103.340126" target="_blank">
										Analco no. 285, Col. Barrio de Analco, Guadalajara,<br>
										Jalisco. C.P. 44450
									</a>
								</h4>
							</div>
						</div>
					</div>
				</div>
				
				<div class="footer-btm py-4 mt-5">
					<div class="row align-items-center justify-content-between">
						<div class="col-lg-12 text-center">
							<div class="copyright">
								Copyright <span class="text-color">ECRO</span> &copy; {{ date('Y') }} - {{ date('Y',strtotime('4 year')) }}
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4">
							<a class="backtop js-scroll-trigger" href="#top">
								<i class="icofont-long-arrow-up"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</footer>
	    
	    <!-- Main jQuery -->
  		{!!Html::script('landing/plugins/jquery/jquery.js')!!}
	    <!-- Bootstrap 4.3.2 -->
  		{!!Html::script('landing/plugins/bootstrap/js/popper.js')!!}
  		{!!Html::script('landing/plugins/bootstrap/js/bootstrap.min.js')!!}
  		{{-- {!!Html::script('landing/plugins/counterup/jquery.easing.js')!!} --}}
	    <!-- Slick Slider -->
  		{!!Html::script('landing/plugins/slick-carousel/slick/slick.min.js')!!}
	    <!-- Counterup -->
  		{!!Html::script('landing/plugins/counterup/jquery.waypoints.min.js')!!}
	    
  		{!!Html::script('landing/plugins/shuffle/shuffle.min.js')!!}
  		{!!Html::script('landing/plugins/counterup/jquery.counterup.min.js')!!}
		@yield('scripts')
	</body>
</html>
   