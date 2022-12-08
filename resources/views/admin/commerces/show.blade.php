@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Nom Commerce: {{$commerce['nomCom']}}</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title">Adresse</h5>
            <p class="card-text">
                {{ $commerce['ad1Com'] }} {{ $commerce->ville->ville_nom }}
            </p>
            <h5 class="card-title">Coordonnées GPS</h5>
            <p class="card-text">
                <span class="badge badge-primary">Latitude : {{ $commerce['latCom'] }}</span>
                <span class="badge badge-primary">Longitude : {{ $commerce['longCom'] }}</span>
            </p>
            <h5 class="card-title">Téléphone</h5>
            <p class="card-text">
                {{ $commerce['telCom'] }}
            </p>
            <h5 class="card-title">Mail</h5>
            <p class="card-text">
                {{ $commerce['mailCom'] }}
            </p>
            <h5 class="card-title">Description</h5>
            <p class="card-text">
                {!! $commerce['descCom'] !!}
            </p>
            <h5 class="card-title">Siret</h5>
            <p class="card-text">
                {{ $commerce['siretCom'] }}
            </p>
            <h5 class="card-title">Etat</h5>
            <p class="card-text">
                @if($commerce['etatCom'] === 0)
                    En attente
                @elseif($commerce['etatCom'] === 1)
                    Validé et Activé
                @else
                    Validé et Désactivé
                @endif
            </p>
            <h5 class="card-title">Code</h5>
            <p class="card-text">
                {{ $commerce['codeCom'] }}
            </p>
            <h5 class="card-title">Catégorie</h5>
            <p class="card-text">
                <span class="badge badge-primary">
                {{ $commerce->categorie->libCat }}
                </span>
            </p>
            <h5 class="card-title">Sous-Catégorie</h5>
            <p class="card-text">
                @foreach ($commerce->categorie->souscategories as $souscategory)
                    @if($souscategory->id === $commerce->sous_categorie_id)
                        <span class="badge badge-secondary">
                                    {{ $souscategory->libSousCat }}
                                </span>
                    @endif
                @endforeach
            </p>
        <h5 class="card-title">Photo du commerce</h5>
        <p class="card-text">
            @foreach($photos as $photo)
                @if($photo->commerce_id === $commerce->id)
                    <img src="{{ asset("uploads/commerces/".$photo->cheminPhoto) }}" alt="{{ $photo->descPhoto }}" width="100px">
                @else
                @endif
            @endforeach
        </p>
    </div>

        <div class="card-footer d-flex justify-content-between">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
            <div class="d-flex align-items-center">
                @if($user->hasRole('moderateur') || $user->hasRole('admin'))
                    <h4>Valider le commerce ?</h4>
                    @if($commerce['etatCom'] ===  0)
                        <a href="#" data-toggle="modal" data-target="#validateModal" data-commerceid="{{$commerce['id']}}" class="p-2"><i class="fas fa-check"></i></a>
                    @endif
                @endif
            </div>

        </div>
    </div>
</div>

<!-- validate Modal-->
<div class="modal fade" id="validateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Validez-vous ce commerce ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Sélectionner "Valider" pour confirmer.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                <form method="POST" action="">
                    @method('DELETE')
                    @csrf
                    {{-- <input type="hidden" id="commerce_id" name="commerce_id" value=""> --}}
                    <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Valider</a>
                </form>
            </div>
        </div>
    </div>
</div>

@section('js_categorie_page')

    <script>
        $('#validateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var commerce_id = button.data('commerceid')


            var modal = $(this)
            // modal.find('.modal-footer #commerce_id').val(commerce_id)
            modal.find('form').attr('action','/commerces/' + commerce_id);
        })
    </script>

@endsection
@endsection
