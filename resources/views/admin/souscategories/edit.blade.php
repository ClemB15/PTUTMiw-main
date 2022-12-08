@extends('admin.layouts.dashboard')

@section('content')

<h1>Modifier une Sous-Catégorie</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/souscategories/{{$souscategorie->id}}">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="libSousCat">Libellé Sous-Catégorie</label>
        <input type="text" name="libSousCat" class="form-control" id="libSousCat" placeholder="Libellé Sous-Catégorie..." value="{{$souscategorie->libSousCat}}" required>
    </div>
    <div class="form-group" >
        <label for="categories">Changer de catégorie</label>
        <select data-role="tagsinput" name="categorie_id" class="form-control" id="categorie_id">
            @foreach ($categories as $category)
                @if ($category->id === $souscategorie->categorie_id)
                    <option value="{{$category->id}}" selected>{{$category->libCat}}</option>
                    @else
                <option value="{{$category->id}}">{{$category->libCat}}</option>
                @endif

            @endforeach
        </select>
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

@endsection

@endsection
