@extends('admin.layouts.dashboard')

@section('content')

<h1>Créer un Avis</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(!isset($commerce))
    <form method="GET" action="">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="codeCom">Entrer le code du Commerce</label>
            <input type="text" name="codeCom" class="form-control" id="codeCom" placeholder="Code commerce..." value="{{ old('codeCom') }}" required>
        </div>
        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Trouver le commerce">
        </div>
    </form>
@else
    <form method="POST" action="/commentaires">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="commerce_id">Nom du commerce : <strong>{{ $commerce['nomCom'] }}</strong></label>
            <input type="hidden" name="commerce_id" id="commerce_id" value="{{ $commerce['id'] }}" required>
            <input type="hidden" name="codeCommerce" value="{{ $codeCom }}" required>
        </div>
        <div class="form-group">
            <h2>Note</h2>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="note1" name="note" class="custom-control-input" value="1">
                <label class="custom-control-label" for="note1">1</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="note2" name="note" class="custom-control-input" value="2">
                <label class="custom-control-label" for="note2">2</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="note3" name="note" class="custom-control-input" value="3">
                <label class="custom-control-label" for="note3">3</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="note4" name="note" class="custom-control-input" value="4">
                <label class="custom-control-label" for="note4">4</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="note5" name="note" class="custom-control-input" value="5">
                <label class="custom-control-label" for="note5">5</label>
            </div>
        </div>
        <div class="form-group">
            <label for="commentaireAvis">Commentaire</label>
            <textarea type="text" name="commentaireAvis" class="form-control" id="commentaireAvis" placeholder="Commentaire..." required>{{ old('commentaireAvis') }}</textarea>
        </div>

        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Publier son avis">
        </div>
    </form>
@endif
@section('css_categorie_page')
    <link rel="stylesheet" href="/css/admin/bootstrap-tagsinput.css">
@endsection

@section('js_categorie_page')
    <script src="/js/admin/bootstrap-tagsinput.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'commentaireAvis' );
        // CKEDITOR.replace( 'descPhoto' );
    </script>
@endsection

@endsection
