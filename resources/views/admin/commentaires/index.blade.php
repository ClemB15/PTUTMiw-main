@extends('admin.layouts.dashboard')

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row py-lg-2">
            <div class="col-md-6">
                <h2>La liste des Avis</h2>
            </div>
            <div class="col-md-6">
                <a href="/commentaires/create" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Créer un Avis</a>
            </div>
        </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Commerce</th>
                <th>Crée le</th>
                <th>Modifié le</th>
                <th>Gestion</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Commerce</th>
                <th>Crée le</th>
                <th>Modifié le</th>
                <th>Gestion</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($commentaires as $commentaire)
                    <tr>
                        <td>{{ $commentaire['note'] }}<strong>/5</strong></td>
                        <td>{!! $commentaire['commentaireAvis'] !!}</td>
                        <td>{{ $commentaire->commerce->nomCom }}</td>
                        <td>{{ $commentaire['created_at'] }}</td>
                        <td>{{ $commentaire['updated_at'] }}</td>
                        <td>
                            <a href="/commentaires/{{ $commentaire['id'] }}"><i class="fa fa-eye"></i></a>
                            <a href="/commentaires/{{ $commentaire['id'] }}/edit"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal" data-commentaireid="{{$commentaire['id']}}"><i class="fas fa-trash-alt"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Voulez-vous supprimer cet Avis ?</h5>
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
            {{-- <input type="hidden" id="commentaire_id" name="commentaire_id" value=""> --}}
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
        var commentaire_id = button.data('commentaireid')


        var modal = $(this)
        // modal.find('.modal-footer #commentaire_id').val(commentaireid)
        modal.find('form').attr('action','/commentaires/' + commentaire_id);
    })
</script>

@endsection
@endsection
