@extends('admin.layouts.dashboard')

@section('content')

<h1>Créer un Produit</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/produits" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="commerce_id">Nom du Commerce</label>
        <select data-role="tagsinput" name="commerce_id" class="form-control" id="commerce_id">
            @foreach ($commerces as $commerce)
                <option value="{{$commerce->id}}">{{$commerce->nomCom}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="labelProd">Label du Produit</label>
        <input type="text" name="labelProd" class="form-control" id="labelProd" placeholder="Label du Produit..." value="{{ old('labelProd') }}" required>
    </div>
    <div class="form-group">
        <label for="descProd">Description du Produit</label>
        <textarea type="text" name="descProd" class="form-control" id="descProd" placeholder="Description du produit..." required>{{ old('descProd') }}</textarea>
    </div>
    <div class="form-group">
        <label for="cheminPhotoProd">Photo du Produit</label>
        <input type="file" name="cheminPhotoProd" class="form-control-file" id="cheminPhotoProd" value="{{ old('cheminPhotoProd') }}">
    </div>
    <div class="form-group">
        <label for="prixProd">Prix du produit</label>
        <input type="number" name="prixProd" class="form-control" id="prixProd" placeholder="...€" value="{{ old('prixProd') }}" required>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="quantiteProd">Quantité du Produit</label>
        <input type="number" name="quantiteProd" class="form-control" id="quantiteProd" value="{{ old('quantiteProd') }}">
        </div>
        <div class="form-group col-md-6">
            <label for="unite_id">Unité</label>
            <select data-role="tagsinput" name="unite_id" class="custom-select" id="unite_id" required>
                @foreach ($unites as $unite)
                    <option value="{{$unite->id}}">{{$unite->libelleUnit}}</option>
                @endforeach
            </select>
        </div>
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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'descProd' );
    </script>
@endsection

@endsection
