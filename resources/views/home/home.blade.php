<!DOCTYPE HTML>

<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Baluchon </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/ico" href="{{asset('images/favicon.ico') }}"/>

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- Animate.css -->
	<link rel="stylesheet" href="{{asset('css/home/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{asset('css/home/icomoon.css') }}">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="{{asset('css/home/themify-icons.css') }}">

	<link rel="stylesheet" href="{{asset('css/home/bootstrap.css') }}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('css/home/magnific-popup.css') }}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('css/home/bootstrap-datepicker.min.css') }}">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="{{asset('css/home/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{asset('css/home/owl.theme.default.min.css') }}">

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{asset('css/home/style.css') }}">

	<!-- Modernizr JS -->
	<script src="{{asset('js/home/modernizr-2.6.2.min.js') }}"></script>

        <style>
            .btn a{
                color: white;
            }
        </style>
	</head>
	<body>

	<div class="gtco-loader"></div>

	<div id="page">

	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">

			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="{{ route('home') }}">Baluchon</a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="{{ route('home') }}">Accueil</a></li>
						<li class="has-dropdown">
							<a href="{{ route('map') }}">Voir la Carte</a>
						</li>
						<li><a href="{{ route('cgu') }}">Mentions Légales</a></li>
					</ul>
				</div>
			</div>

		</div>
	</nav>

	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" >
		<div class="overlay">
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12 col-md-offset-0 text-left">


						<div class="row row-mt-15em">
							<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
								<h1>La Solution en quelques clic !</h1>
                                <button type="button" class="btn btn-success"><a href="{{ route('map') }}">Trouvez Votre Commerce</a></button>
							</div>

						</div>


					</div>
				</div>
			</div>
		</div>
	</header>


	<div id="gtco-features">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2>Comment ça marche ?</h2>
					<!--<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>-->
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>1</i>
						</span>
						<p>Trouvez facilement et rapidement les commerces de proximités </p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>2</i>
						</span>
						<p>Consultez les informations ainsi que les produits de chaques commerces</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>3</i>
						</span>
						<p> Contactez les commercants si vous souhaitez effectuer une commande </p>
					</div>
				</div>


			</div>
		</div>
	</div>


	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Baluchon est présent partout !</h2>
				</div>
			</div>
			<div class="row-deux">

				<div class="col-lg-4 col-md-4 col-sm-6">
						<figure>
							<img src="./images/paris.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Paris</h2>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
						<figure>
							<img src="./images/lyon.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Lyon</h2>
						</div>

					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
						<figure>
							<img src="./images/nantes.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Nantes</h2>
						</div>

					</a>
				</div>


				<div class="col-lg-4 col-md-4 col-sm-6">
						<figure>
							<img src="./images/nice.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Nice</h2>

						</div>
					</a>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6">
						<figure>
							<img src="images/toulouse.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Toulouse</h2>
						</div>
					</a>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6">
						<figure>
							<img src="images/bordeaux.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Bordeaux</h2>

						</div>
					</a>
				</div>

			</div>
		</div>
	</div>




	<div class="gtco-cover gtco-cover-sm"   data-stellar-background-ratio="0.5">
		<div class="gtco-container text-center">
			<div class="display-t">
				<div class="display-tc">
					<h1>Soyons solidaires et aidons les commerces de proximités !</h1>
				</div>
			</div>
		</div>
	</div>






	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
			<div class="row row-p b-md">
					<div class="gtco-widget">
						<h3>À propos de nous</h3>
						<p>Nous sommes 4 étudiants en Licence Pro MIW de Gap. Il s'agit du site de notre projet tuteuré !!</p>
					</div>



			</div>



		</div>
	</footer>
	<!-- </div> -->

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="fas fa-arrow-up"></i></a>
	</div>

	<!-- jQuery -->
	<script src="{{asset('js/home/jquery.min.js') }}" ></script>
	<!-- jQuery Easing -->
	<script src="{{asset('js/home/jquery.easing.1.3.js') }}" ></script>
	<!-- Bootstrap -->
	<script src="{{asset('js/home/bootstrap.min.js') }}" ></script>
	<!-- Waypoints -->
	<script src="{{asset('js/home/jquery.waypoints.min.js') }}"></script>
	<!-- Carousel -->
	<script src="{{asset('js/home/owl.carousel.min.js') }}" ></script>
	<!-- countTo -->
	<script src="{{asset('js/home/jquery.countTo.js') }}" ></script>

	<!-- Stellar Parallax -->
	<script src="{{asset('js/home/jquery.stellar.min.js') }}" ></script>

	<!-- Magnific Popup -->
	<script src="{{asset('js/home/jquery.magnific-popup.min.js') }}" ></script>
	<script src="{{asset('js/home/magnific-popup-options.js') }}" ></script>

	<!-- Datepicker -->
	<script src="{{asset('js/home/bootstrap-datepicker.min.js') }}" ></script>


	<!-- Main -->
	<script src="{{asset('js/home/main.js') }}"></script>

	</body>
</html>

