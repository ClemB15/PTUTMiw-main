@extends('admin.layouts.dashboard')

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row py-lg-2">
            <div class="col-md-6">
                <h2>La liste des Sous-Catégories</h2>
            </div>
            <div class="col-md-6">
                <a href="/souscategories/create" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Créer une Sous-Catégorie</a>
            </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Id</th>
                <th>Sous-Catégories</th>
                <th>Catégorie</th>
                <th>Gestion</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Sous-Catégories</th>
                <th>Catégorie</th>
                <th>Gestion</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($souscategories as $souscategorie)
                    <tr>
                        <td>{{ $souscategorie['id'] }}</td>
                        <td>{{ $souscategorie['libSousCat'] }}</td>
                        <td>
                                <span class="badge badge-secondary">
                                    {{ $souscategorie->categorie->libCat }}
                                </span>
                        </td>
                        <td>
                            <a href="/souscategories/{{ $souscategorie['id'] }}"><i class="fa fa-info"></i></a>
                            <a href="/souscategories/{{ $souscategorie['id'] }}/edit"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal" data-souscategorieid="{{$souscategorie['id']}}"><i class="fas fa-trash-alt"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Voulez-vous supprimer cette sous-catégorie ?</h5>
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
            {{-- <input type="hidden" id="souscategorie_id" name="souscategorie_id" value=""> --}}
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
        var souscategorie_id = button.data('souscategorieid')


        var modal = $(this)
        // modal.find('.modal-footer #categorie_id').val(categorie_id)
        modal.find('form').attr('action','/souscategories/' + souscategorie_id);
    })
</script>

@endsection


@endsection
