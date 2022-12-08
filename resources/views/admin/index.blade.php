@extends('admin.layouts.dashboard')

@section('content')

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Gestion</a>
    </li>
    <li class="breadcrumb-item active">Statistiques</li>
  </ol>

    <div class="card mb-3">
        <div class="card-header">
            @if(count($commerces) > 1)
                <form method="GET" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="commerce_id">Nom du Commerce</label>
                        <select data-role="tagsinput" name="commerce_id" class="form-control" id="commerce_id">
                            @foreach ($commerces as $commerce)
                                @if(!$comm == '')
                                    @if ($commerce->id === $comm->id)
                                        <option value="{{$commerce->id}}" selected>{{$commerce->nomCom}}</option>
                                    @else
                                        <option value="{{$commerce->id}}">{{$commerce->nomCom}}</option>
                                    @endif
                                @else
                                    <option value="{{$commerce->id}}">{{$commerce->nomCom}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group pt-2">
                        <input class="btn btn-primary" type="submit" value="Sélectionner">
                    </div>
                </form>
            @elseif(count($commerces) == 0)
                <div class="alert alert-warning" role="alert">
                    Vous n'avez pas de commerce enregistré !
                    <a href="/commerces/create" class="alert-link" role="button" aria-pressed="true">Créer un Commerce</a>
                </div>
            @endif
            @if(!$comm === null)
                <h2 class="text-center"><p class="card-subtitle mb-2 text-muted">Nom du commerce : </p>{{ $comm->nomCom }}</h2>
                @endif
        </div>
        @if(count($commerces) == 0)

        @else
            <div class="card-body d-flex justify-content-around">
                <div class="card text-center text-white bg-info mb-3 flex-fill" style="width: 18rem;">
                    <div class="card-header">Nombre de Consultation</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ count($consultations) }}</h5>
                        @if(count($consultations) == 0)
                            <p class="card-text">Pas de consultation</p>
                        @else
                            <p class="card-text">Dernière consultation le : {{ $consultations[0]['dateConsultation'] }}</p>
                        @endif
                    </div>
                </div>
                <div class="card text-center text-white bg-secondary mb-3 flex-fill" style="width: 18rem;">
                    <div class="card-header">Nombre d'Avis</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ count($commentaires) }} avis</h5>
                        @if(count($commentaires) == 0)
                            <p class="card-text">Pas d'avis</p>
                        @else
                            <p class="card-text">Dernier avis le : {{ $commentaires[0]['created_at'] }}</p>
                        @endif
                    </div>
                </div>
                <div class="card text-center text-white bg-success mb-3 flex-fill" style="width: 18rem;">
                    <div class="card-header">Nombre de Produits</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ count($produits) }}</h5>
                        @if(count($produits) == 0)
                            <div class="alert alert-warning" role="alert">
                                Vous n'avez pas de produit enregistré !
                                <a href="/produits/create" class="alert-link" role="button" aria-pressed="true">Créer un produit</a>
                            </div>
                        @else
                            <p class="card-text">Dernier produit ajouté :<br/> {{ $produits[0]['labelProd'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @if(!count($commentaires) == 0)
                <div class="card-body">
                    <h4 class="card-title">Note moyenne :</h4>
                    <h5 class="card-subtitle mb-2 text-muted">{{ $notes }}/5</h5>
                    <div class="card-deck">
                        @foreach($commentaires as $commentaire)
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $commentaire->note }}/5</h5>
                                    <p class="card-text">{!! $commentaire->commentaireAvis !!}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Dernière modification le {{ $commentaire->updated_at }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </div>



@endsection
