@extends('admin.layouts.dashboard')

@section('content')

<h1>Modifier une Catégorie</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/commentaires/{{$commentaire->id}}">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <strong>{{ $commentaire->commerce->nomCom }}</strong>
    </div>

    <div class="custom-control custom-radio custom-control-inline">
        @if($commentaire->note == 1)
            <input type="radio" id="note1" name="note" class="custom-control-input" value="1" checked>
        @else
            <input type="radio" id="note1" name="note" class="custom-control-input" value="1">
        @endif
        <label class="custom-control-label" for="note1">1</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        @if($commentaire->note == 2)
            <input type="radio" id="note2" name="note" class="custom-control-input" value="2" checked>
        @else
            <input type="radio" id="note2" name="note" class="custom-control-input" value="2">
        @endif
        <label class="custom-control-label" for="note2">2</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        @if($commentaire->note == 3)
            <input type="radio" id="note3" name="note" class="custom-control-input" value="3" checked>
        @else
            <input type="radio" id="note3" name="note" class="custom-control-input" value="3">
        @endif
        <label class="custom-control-label" for="note3">3</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        @if($commentaire->note == 4)
            <input type="radio" id="note4" name="note" class="custom-control-input" value="4" checked>
        @else
            <input type="radio" id="note4" name="note" class="custom-control-input" value="4">
        @endif
        <label class="custom-control-label" for="note4">4</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        @if($commentaire->note == 5)
            <input type="radio" id="note5" name="note" class="custom-control-input" value="5" checked>
        @else
            <input type="radio" id="note5" name="note" class="custom-control-input" value="5">
        @endif
        <label class="custom-control-label" for="note5">5</label>
    </div>
    <div class="form-group">
        <label for="commentaireAvis">Commentaire</label>
        <textarea type="text" name="commentaireAvis" class="form-control" id="commentaireAvis" placeholder="Commentaire..." required>{{ $commentaire->commentaireAvis }}</textarea>
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Modifier">
    </div>
</form>

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
