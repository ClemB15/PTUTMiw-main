@extends('admin.layouts.dashboard')

@section('content')

<h1>Créer une nouvelle Sous-Catégorie</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/souscategories">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="libSousCat">Libellé Sous-Catégorie</label>
        <input type="text" name="libSousCat" class="form-control" id="libSousCat" placeholder="Libellé Sous-Catégorie..." value="{{ old('libSousCat') }}" required>
    </div>
    <div class="form-group" >
        <label for="categorie_id">Choisir une Catégorie</label>
        <select data-role="tagsinput" name="categorie_id" class="form-control" id="categorie_id">
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->libCat}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Créer">
    </div>
</form>

@section('css_categorie_page')
    <link rel="stylesheet" href="/css/admin/bootstrap-tagsinput.css">
@endsection

@section('js_categorie_page')
    <script src="/js/admin/bootstrap-tagsinput.js"></script>

@endsection

@endsection
