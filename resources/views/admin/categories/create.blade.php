@extends('admin.layouts.dashboard')

@section('content')

    @php
        $dir = 'images/map-icons/*.png';
        $images = glob($dir,GLOB_BRACE);
   @endphp
<h1>Créer une nouvelle Catégorie</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/categories">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="libCat">Libellé Catégorie</label>
        <input type="text" name="libCat" class="form-control" id="libCat" placeholder="Libellé Catégorie..." value="{{ old('libCat') }}" required>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="sel">
            Marker Catégorie
            <span class="glyphicon glyphicon-chevron-down"></span>
        </button>

        <ul class="dropdown-menu scrollable-menu text-center" role="menu">
            @foreach ($images as $image)
                <li><img src="{{ asset($image) }}" alt="{{ $image }}" width="30px"></li>
            @endforeach
        </ul>
    </div>
    <div class="form-group">
        <label for="cheminMarkerCat">Marker selectionné</label>
        <input type="hidden" name="cheminMarkerCat" class="form-control" id="cheminMarkerCat" placeholder="Marker Catégorie..." required><br/>
        <span id="imagesMarker"></span>
    </div>
    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Créer">
    </div>
</form>

@section('css_categorie_page')
    <link rel="stylesheet" href="/css/admin/bootstrap-tagsinput.css">
    <style>
        .scrollable-menu {
            height: auto;
            max-height: 250px;
            overflow-x: hidden;
        }
    </style>
@endsection

@section('js_categorie_page')
    <script src="/js/admin/bootstrap-tagsinput.js"></script>
    <script>
        $('.scrollable-menu li').click ( function(){
            var img=  $(this).html();
            $("#imagesMarker").empty();
            $("#imagesMarker").append(img);
            $('#cheminMarkerCat').val(img);
        })
    </script>
@endsection

@endsection
