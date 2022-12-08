@extends('admin.layouts.dashboard')

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row py-lg-2">
            <div class="col-md-6">
                <h2>La liste des Commerces</h2>
            </div>
            <div class="col-md-6">
                @if(!$user->hasRole('moderateur'))
                    <a href="/commerces/create" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Créer un Commerce</a>
                @endif
            </div>
        </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Nom Commerce</th>
                <th>Adresse</th>
                <th>Coordonnées GPS</th>
                <th>Téléphone</th>
                <th>Description</th>
                <th>Siret</th>
                <th>Etat</th>
                <th>Code</th>
                <th>Catégorie / Sous-Catégorie</th>
                <th>Photo</th>
                <th>Gestion</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Nom Commerce</th>
                <th>Adresse</th>
                <th>Coordonnées GPS</th>
                <th>Téléphone</th>
                <th>Description</th>
                <th>Siret</th>
                <th>Etat</th>
                <th>Code</th>
                <th>Catégorie / Sous-Catégorie</th>
                <th>Photo</th>
                <th>Gestion</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($commerces as $commerce)
                    <tr>
                        <td>{{ $commerce['nomCom'] }}</td>
                        <td>{{ $commerce['ad1Com'] }}
                            @if($commerce['ad2Com'] != null)
                            {{ $commerce['ad2Com'] }}
                            @endif
                            <strong>{{ $commerce->ville->ville_nom }}</strong></td>
                        <td>
                            <span class="badge badge-primary">Latitude : {{ $commerce['latCom'] }}</span>
                            <span class="badge badge-primary">Longitude : {{ $commerce['longCom'] }}</span>
                        </td>
                        <td>{{ $commerce['telCom'] }}</td>
                        <td>{!! $commerce['descCom'] !!}</td>
                        <td>{{ $commerce['siretCom'] }}</td>
                        <td>
                            @if($commerce['etatCom'] === 0)
                                En attente
                            @elseif($commerce['etatCom'] === 1)
                                Validé et Activé
                            @else
                                Validé et Désactivé
                            @endif
                            </td>
                        <td>{{ $commerce['codeCom'] }}</td>
                        <td>
                                <span class="badge badge-primary">
                                    {{ $commerce->categorie->libCat }}
                                </span>
                            @foreach ($commerce->categorie->souscategories as $souscategory)
                                @if($souscategory->id === $commerce->sous_categorie_id)
                                <span class="badge badge-secondary">
                                    {{ $souscategory->libSousCat }}
                                </span>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($photos as $photo)
                                @if($photo->commerce_id === $commerce->id)
                                    <img src="{{ asset("uploads/commerces/".$photo->cheminPhoto) }}" alt="{{ $photo->descPhoto }}" width="150px">
                                @else
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="/commerces/{{ $commerce['id'] }}"><i class="fa fa-info"></i></a>
                            @if(!$user->hasRole('moderateur'))
                                <a href="/commerces/{{ $commerce['id'] }}/edit"><i class="fa fa-edit"></i></a>
                                @if($commerce['etatCom'] === 1)
                                    <a href="#" data-toggle="modal" data-target="#disableModal" data-commerceid="{{$commerce['id']}}"><i class="fas fa-eye-slash"></i></a>
                                @elseif($commerce['etatCom'] === 2)
                                    <a href="#" data-toggle="modal" data-target="#enableModal" data-commerceid="{{$commerce['id']}}"><i class="fas fa-eye"></i></a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

<!-- disable Modal-->
<div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Voulez-vous désactiver ce commerce ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">Sélectionner "désactiver" pour confirmer.</div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
        <form method="POST" action="">
            @method('DELETE')
            @csrf
            {{-- <input type="hidden" id="commerce_id" name="commerce_id" value=""> --}}
            <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Désactiver</a>
        </form>
        </div>
    </div>
    </div>
</div>

<!-- enable Modal-->
<div class="modal fade" id="enableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Voulez-vous activer ce commerce ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Sélectionner "Activer" pour confirmer.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                <form method="POST" action="">
                    @method('DELETE')
                    @csrf
                    {{-- <input type="hidden" id="commerce_id" name="commerce_id" value=""> --}}
                    <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Activer</a>
                </form>
            </div>
        </div>
    </div>
</div>

@section('js_categorie_page')

<script>
    $('#disableModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var commerce_id = button.data('commerceid')


        var modal = $(this)
        // modal.find('.modal-footer #commerce_id').val(commerce_id)
        modal.find('form').attr('action','/commerces/' + commerce_id);
    })
</script>
<script>
    $('#enableModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var commerce_id = button.data('commerceid')


        var modal = $(this)
        // modal.find('.modal-footer #commerce_id').val(commerce_id)
        modal.find('form').attr('action','/commerces/' + commerce_id);
    })
</script>

@endsection


@endsection
