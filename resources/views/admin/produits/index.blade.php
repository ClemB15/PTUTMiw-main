@extends('admin.layouts.dashboard')

@section('content')


<div class="card mb-3">
    <div class="card-header">
        <div class="row py-lg-2">
            <div class="col-md-6">
                <h2>La liste des Produits</h2>
            </div>
            <div class="col-md-6">
                <a href="/produits/create" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Créer un Produit</a>
            </div>
        </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Label</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Photo</th>
                <th>Quantité</th>
                <th>Unité</th>
                <th>Nom Commerce</th>
                <th>Gestion</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Label</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Photo</th>
                <th>Quantité</th>
                <th>Unité</th>
                <th>Nom Commerce</th>
                <th>Gestion</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($produits as $produit)
                    @if(!$user->hasRole('admin'))
                        @if($produit->commerce->user_id === $user->id)
                            <tr>
                                <td>{{ $produit['labelProd'] }}</td>
                                <td>{!! $produit['descProd'] !!}</td>
                                <td>{{ $produit['prixProd'] }}<strong>€</strong></td>
                                <td>
                                    <img src="{{ asset("uploads/produits/".$produit['cheminPhotoProd']) }}" alt="{{ $produit['labelProd'] }}" width="100px">
                                </td>
                                <td>{{ $produit['quantiteProd'] }}</td>
                                <td>
                                    @foreach($unites as $unite)
                                        @if($produit->unite_id === $unite->id)
                                            {{ $unite->libelleUnit }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($commerces as $commerce)
                                        @if($produit->commerce_id === $commerce->id)
                                            {{ $commerce->nomCom }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="/produits/{{ $produit['id'] }}"><i class="fa fa-info"></i></a>
                                    <a href="/produits/{{ $produit['id'] }}/edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#deleteModal" data-produitid="{{$produit['id']}}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endif
                    @else
                    <tr>
                        <td>{{ $produit['labelProd'] }}</td>
                        <td>{!! $produit['descProd'] !!}</td>
                        <td>{{ $produit['prixProd'] }}<strong>€</strong></td>
                        <td>
                            <img src="{{ asset("uploads/produits/".$produit['cheminPhotoProd']) }}" alt="{{ $produit['labelProd'] }}" width="100px">
                        </td>
                        <td>{{ $produit['quantiteProd'] }}</td>
                        <td>
                            @foreach($unites as $unite)
                                @if($produit->unite_id === $unite->id)
                                    {{ $unite->libelleUnit }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($commerces as $commerce)
                                @if($produit->commerce_id === $commerce->id)
                                    {{ $commerce->nomCom }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="/produits/{{ $produit['id'] }}"><i class="fa fa-info"></i></a>
                            <a href="/produits/{{ $produit['id'] }}/edit"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal" data-produitid="{{$produit['id']}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

<!-- delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Voulez-vous supprimer ce produit ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Sélectionner "supprimer" pour confirmer.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="">
                    @method('DELETE')
                    @csrf
                    {{-- <input type="hidden" id="produit_id" name="produit_id" value=""> --}}
                    <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Delete</a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@section('js_categorie_page')

    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var produit_id = button.data('produitid')

            var modal = $(this)
            // modal.find('.modal-footer #user_id').val(user_id)
            modal.find('form').attr('action','/produits/' + produit_id);
        })
    </script>

@endsection


@endsection
