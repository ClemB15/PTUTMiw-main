@extends('admin.layouts.dashboard')

@section('content')

<h1>Créer une nouvelle Unité</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/unites">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="libelleUnit">Libellé Unité</label>
        <input type="text" name="libelleUnit" class="form-control" id="libelleUnit" placeholder="Libellé Unité..." value="{{ old('libelleUnit') }}" required>
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
