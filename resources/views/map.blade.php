<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{{-- include global js variables --}}
	@include('footervarview')

	<!-- ... -->

	<link rel="shortcut icon" type="image/ico" href="{{asset('images/favicon.ico') }}"/>

	
	{{-- leaflet /markercluster style imports --}}
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
	<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">

	{{-- leaflet /markercluster script imports --}}
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
	<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>

	{{-- ajax --}}
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	{{-- fotawesome --}}
	<script src="https://kit.fontawesome.com/fe664ea98e.js" crossorigin="anonymous"></script>
    {{-- CKEditor --}}
    <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

	<link rel="stylesheet" href="{{mix('css/reset.css') }}">
	<link rel="stylesheet" href="{{mix('css/home.css') }}">

	<script src="{{mix('js/icon-provider.js') }}"></script>
	<script src="{{mix('js/function_map_and_filter.js') }}"></script>

	<script src="{{mix('js/homeMain.js') }}"></script>
	<script>
		function manageHours() {
            console.log('test');
        }
	</script>

</head>

<body>

	<div class="page">
		<div class="left-pannel">
			<div class="top">
				<div class="search-container">
					<input id="search" placeholder="Recherche" autocomplete="off"/>
					<div class="items"></div>
				</div>

				<div class="profile" id="profile-btn">
					<a href="/profile">
						<img src="images/svg/ico_profile.svg" alt="image de profile">
						<div class="profile-hover">
                            @if (!Auth::guest())
                                Mon Profil
                            @else
                                Connexion/Inscription
                            @endif
                        </div>
					</a>
				</div>
			</div>

			<div class="bottom">
				{{-- boutton d ouverture des filtres en mobile --}}
				<div class="filter" id="filter-btn">
					<div class="filter-logo">
						<i class="fas fa-filter"></i>
					</div>
					<p>Filtres</p>
				</div>
			</div>

				{{-- conteneur des filtres en mobile --}}
			<div class="filter-content">
				<div class="label-filter">Filtres Acuels :</div>
				<div class="btn-down-filter">
					<svg xmlns="http://www.w3.org/2000/svg" width="23.094" height="13.532" viewBox="0 0 23.094 13.532">
						<g transform="translate(4.781 -4.781)">
							<g transform="translate(18.313 4.781) rotate(90)">
								<g transform="translate(0)">
									<path d="M13.532,11.572a1.991,1.991,0,0,1-.572,1.381L3.4,22.507A1.992,1.992,0,1,1,.58,19.7l8.149-8.149L.58,3.4A1.993,1.993,0,0,1,3.4.587l9.555,9.555a1.991,1.991,0,0,1,.572,1.431Z" transform="translate(0 0)" fill="#959595"/>
								</g>
							</g>
						</g>
					</svg>
				</div>
				<div class="filter-list"></div>
			</div>
		</div>

		<div id="map"></div>


		<nav id="nav" class="nav">
			<div class="nav-toggle">
				<i class="fas fa-times"></i>
			</div>
			<div id="info-container">	
			</div>
			
		</nav>

	</div>

    <script src="{{mix('js/testAPIGouv.js') }}"></script>
</body>
</html>


