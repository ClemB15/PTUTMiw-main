@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Libellé: {{$categorie['libCat']}}</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title">Marker</h5>
            <p class="card-text">
                <img src="{{ asset("images/map-icons/".$categorie['cheminMarkerCat'].'.png') }}" alt="{{ $categorie['libCat'] }}" width="50px">
            </p>

            <h5 class="card-title">Sous-Catégories</h5>
            <p class="card-text">
                @foreach ($categorie->souscategories as $souscategory)
                    <span class="badge badge-secondary">{{$souscategory->libSousCat}}</span>
                @endforeach
            </p>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
        </div>
    </div>
</div>

@endsection
