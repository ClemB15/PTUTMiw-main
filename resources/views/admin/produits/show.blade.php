@extends('admin.layouts.dashboard')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Nom Produit: {{$produit['labelProd']}}</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title">Commerce</h5>
            <p class="card-text">
                 @foreach($commerces as $commerce)
                        @if($produit->commerce_id === $commerce->id)
                            {{ $commerce->nomCom }}
                        @endif
                    @endforeach
            </p>
            <h5 class="card-title">Description</h5>
            <p class="card-text">
                {!! $produit['descProd'] !!}
            </p>
            <h5 class="card-title">Prix</h5>
            <p class="card-text">
                {{ $produit['prixProd'] }}
            </p>
            <h5 class="card-title">Photo du Produit</h5>
            <p class="card-text">
                <img src="{{ asset("uploads/produits/".$produit['cheminPhotoProd']) }}" alt="{{ $produit['labelProd'] }}" width="150px">
            </p>
            <h5 class="card-title">Quantité/Unité</h5>
            <p class="card-text">
                {{ $produit['quantiteProd'] }}
                @foreach($unites as $unite)
                    @if($produit->unite_id === $unite->id)
                        {{ $unite->libelleUnit }}
                    @endif
                @endforeach
            </p>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
        </div>
    </div>
</div>
@endsection
