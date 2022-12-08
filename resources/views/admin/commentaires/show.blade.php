@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Auteur : {{$commentaire->user->nomUser}} {{$commentaire->user->prenomUser}}</h3>
            <h3>Magasin : {{$commentaire->commerce->nomCom}}</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title">Note</h5>
            <p class="card-text">
                {{ $commentaire['note'] }}
            </p>
            <h5 class="card-title">Commentaire</h5>
            <p class="card-text">
                {!! $commentaire['commentaireAvis'] !!}
            </p>
            <h5 class="card-title">Crée le</h5>
            <p class="card-text">
                {{  $commentaire['created_at'] }}
            </p>
            <h5 class="card-title">Modifié le</h5>
            <p class="card-text">
                {{  $commentaire['updated_at'] }}
            </p>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
        </div>
    </div>
</div>

@endsection
