@extends('admin.layouts.dashboard')

@section('content')


<div class="card mb-3">
    <div class="card-header">
        <div class="row py-lg-2">
            <div class="col-md-6">
                <h2>La liste des Catégories</h2>
            </div>
            <div class="col-md-6">
                <a href="/categories/create" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Créer une Catégorie</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Id</th>
                <th>Catégorie</th>
                <th>Marker</th>
                <th>Sous-Catégories</th>
                <th>Gestion</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Catégorie</th>
                <th>Marker</th>
                <th>Sous-Catégories</th>
                <th>Gestion</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($categories as $categorie)
                    <tr>
                        <td>{{ $categorie['id'] }}</td>
                        <td>{{ $categorie['libCat'] }}</td>
                        <td class="text-center"><img src="{{ asset("images/map-icons/".$categorie['cheminMarkerCat'].'.png') }}" alt="{{ $categorie['libCat'] }}" width="50px"></td>
                        <td>
                            @if ($categorie->souscategories != null)

                                @foreach ($categorie->souscategories as $souscategory)
                                <span class="badge badge-secondary">
                                    {{ $souscategory->libSousCat }}
                                </span>
                                @endforeach

                            @endif
                        </td>
                        <td>
                            <a href="/categories/{{ $categorie['id'] }}"><i class="fa fa-eye"></i></a>
                            <a href="/categories/{{ $categorie['id'] }}/edit"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal" data-categorieid="{{$categorie['id']}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

<!-- delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Voulez-vous supprimer cette catégorie ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">Sélectionner "supprimer" pour confirmer.</div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
        <form method="POST" action="">
            @method('DELETE')
            @csrf
            {{-- <input type="hidden" id="categorie_id" name="categorie_id" value=""> --}}
            <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Supprimer</a>
        </form>
        </div>
    </div>
    </div>
</div>

@section('js_categorie_page')

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var categorie_id = button.data('categorieid')


        var modal = $(this)
        // modal.find('.modal-footer #categorie_id').val(categorie_id)
        modal.find('form').attr('action','/categories/' + categorie_id);
    })
</script>

@endsection


@endsection
