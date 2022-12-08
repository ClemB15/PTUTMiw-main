@extends('admin.layouts.dashboard')

@section('content')

<h1>Nouvel Utilisateur</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/users" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="nomUser">Nom de l'utilisateur</label>
        <input type="text" name="nomUser" class="form-control" id="nomUser" placeholder="Nom..." value="{{ old('nomUser') }}" required>
    </div>
    <div class="form-group">
        <label for="prenomUser">Prénom de l'utilisateur</label>
        <input type="text" name="prenomUser" class="form-control" id="prenomUser" placeholder="Prénom..." value="{{ old('prenomUser') }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ old('email') }}">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password..." required minlength="8">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirmer mot de passe</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Password..." id="password_confirmation">
    </div>
    <div class="form-group">
        <label for="role">Selectionner un Rôle</label>

        <select class="role form-control" name="role" id="role">
            <option value="">Selection Rôle...</option>
            @foreach ($roles as $role)
            <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Créer">
    </div>
</form>

@section('js_user_page')

    <script>

        $(document).ready(function(){

            $('#role').on('change', function() {
                var role = $(this).find(':selected');
                var role_id = role.data('role-id');
                var role_slug = role.data('role-slug');

                $.ajax({
                    url: "/users/create",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                        role_slug: role_slug,
                    }
                });
            });
            });

    </script>

@endsection

@endsection
