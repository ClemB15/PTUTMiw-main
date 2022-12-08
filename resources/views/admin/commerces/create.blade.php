@extends('admin.layouts.dashboard')

@section('content')

<h1>Créer un Commerce</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/commerces" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="nomCom">Nom du Commerce</label>
        <input type="text" name="nomCom" class="form-control" id="nomCom" placeholder="Nom du commerce..." value="{{ old('nomCom') }}" required>
    </div>
    <div class="form-group">
        <label for="ad1Com">Adresse du Commerce</label>
        <input type="text" name="ad1Com" class="form-control" id="ad1Com" placeholder="Adresse du commerce..." value="{{ old('ad1Com') }}" required>
    </div>
    <div class="form-group">
        <label for="ville_id" class="form-label">Choisir une Ville</label>
        <input class="form-control" list="villesList" id="ville_id" name="ville_id" placeholder="Ville a chercher...">
        <datalist id="villesList">
            @foreach ($villes as $ville)
                <option value="{{$ville->ville_nom}}">
            @endforeach
        </datalist>
    </div>
    <span class="fst-italic"><a class="link-info" href="https://www.coordonnees-gps.fr" target="_blank">Si vous ne connaissez pas vos coordonnées GPS</a></span>
    <div class="form-group">
        <label for="latCom">Latitude du Commerce</label>
        <input type="text" name="latCom" class="form-control" id="latCom" placeholder="Latitude du commerce..." value="{{ old('latCom') }}" required>
    </div>
    <div class="form-group">
        <label for="longCom">Longitude du Commerce</label>
        <input type="text" name="longCom" class="form-control" id="longCom" placeholder="Longitude du commerce..." value="{{ old('longCom') }}" required>
    </div>
    <div class="form-group">
        <label for="siretCom">Siret du Commerce</label>
        <input type="text" name="siretCom" class="form-control" id="siretCom" placeholder="Siret du commerce..." value="{{ old('siretCom') }}" required>
    </div>
    <div class="form-group">
        <label for="telCom">Téléphone du Commerce</label>
        <input type="tel" name="telCom" class="form-control" id="telCom" placeholder="Téléphone du commerce..." value="{{ old('telCom') }}" required>
    </div>
    <div class="form-group">
        <label for="mailCom">Mail du Commerce</label>
        <input type="email" name="mailCom" class="form-control" id="mailCom" placeholder="Mail du commerce..." value="{{ old('mailCom') }}" required>
    </div>
    <div class="form-group">
        <label for="siteCom">Site du Commerce</label>
        <input type="text" name="siteCom" class="form-control" id="siteCom" placeholder="Site du commerce..." value="{{ old('siteCom') }}">
    </div>
    <div class="form-group">
        <label for="descCom">Description du Commerce</label>
        <textarea type="text" name="descCom" class="form-control" id="descCom" placeholder="Description du commerce..." required>{{ old('descCom') }}</textarea>
    </div>
    <h4>Horaire du commerce</h4>
    <div class="d-flex">
        <div class="form-floating">
            <input type="text" class="form-control" id="horaireLundi" name="horaireLundi" placeholder="Lundi" value="{{ old('horaireLundi') }}">
            <label for="horaireLundi"></label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="horaireMardi" name="horaireMardi" placeholder="Mardi" value="{{ old('horaireMardi') }}">
            <label for="horaireMardi"></label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="horaireMercredi" name="horaireMercredi" placeholder="Mercredi" value="{{ old('horaireMercredi') }}">
            <label for="horaireMercredi"></label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="horaireJeudi" name="horaireJeudi" placeholder="Jeudi" value="{{ old('horaireJeudi') }}">
            <label for="horaireJeudi"></label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="horaireVendredi" name="horaireVendredi" placeholder="Vendredi" value="{{ old('horaireVendredi') }}">
            <label for="horaireVendredi"></label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="horaireSamedi" name="horaireSamedi" placeholder="Samedi" value="{{ old('horaireSamedi') }}">
            <label for="horaireSamedi"></label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="horaireDimanche" name="horaireDimanche" placeholder="Dimanche" value="{{ old('horaireDimanche') }}">
            <label for="horaireDimanche"></label>
        </div>
    </div>
    <div class="form-group" >
        <label for="categorie_id">Choisir une Catégorie</label>
        <select data-role="tagsinput" name="categorie_id" class="form-control" id="categorie_id" required>
            <option value="" selected="selected">-- Catégories --</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->libCat}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group souscat" style="display: none">
        <label for="sous_categorie_id">Choisir une Sous-Catégorie</label>
        <select data-role="tagsinput" name="sous_categorie_id" class="form-control" id="sous_categorie_id">
            <option value="" selected="selected">-- Sous-Catégories --</option>
            @foreach ($souscategories as $souscategory)
                <option data-categoryid="{{ $souscategory->categorie_id }}" value="{{$souscategory->id}}">{{$souscategory->libSousCat}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="cheminPhoto">Photo du Commerce</label>
        <input type="file" name="cheminPhoto" class="form-control-file" id="cheminPhoto" value="{{ old('cheminPhoto') }}">
    </div>
    <div class="form-group">
        <label for="descPhoto">Description de la photo</label>
        <textarea type="text" name="descPhoto" class="form-control" id="descPhoto" placeholder="Description de la photo...">{{ old('descPhoto') }}</textarea>
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Créer">
    </div>
</form>

@section('css_categorie_page')
    <link rel="stylesheet" href="/css/admin/bootstrap-tagsinput.css">
@endsection

@section('js_categorie_page')

    <script src="/js/admin/bootstrap-tagsinput.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function(){
            $('#categorie_id').change(function() {
                const categorie_id = this.value;
                $('.souscat').show();

                $("#sous_categorie_id > option").each(function() {
                   $(this).data('categoryid');
                });

                var $current = $('#sous_categorie_id option[data-categoryid="' + categorie_id + '"]').toggle();
                $('#sous_categorie_id option').not($current).hide()
            });
        });


        CKEDITOR.replace( 'descCom' );
        CKEDITOR.replace( 'descPhoto' );
    </script>
@endsection

@endsection
