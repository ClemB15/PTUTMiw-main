@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Libellé: {{$souscategorie['libSousCat']}}</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title">Catégorie</h5>
            <p class="card-text">
                {{ $souscategorie->categorie->libCat }}
            </p>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
        </div>
    </div>
</div>

@endsection
