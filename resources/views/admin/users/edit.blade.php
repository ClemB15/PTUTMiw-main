@extends('admin.layouts.dashboard')

@section('content')

<h2>Edit User</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    @if($user === null)
        <form method="POST" action="/users/{{ Auth::user()->id }}" enctype="multipart/form-data">
    @else
        <form method="POST" action="/users/{{ $user->id }}" enctype="multipart/form-data">
    @endif
    @method('PATCH')
    @csrf()

    <div class="form-group">
        <label for="nomUser">Nom de l'utilisateur</label>
        @if($user === null)
            <input type="text" name="nomUser" class="form-control" id="nomUser" placeholder="Nom..." value="{{ Auth::user()->nomUser }}" required>
        @else
            <input type="text" name="nomUser" class="form-control" id="nomUser" placeholder="Nom..." value="{{ $user->nomUser }}" required>
        @endif
    </div>
    <div class="form-group">
        <label for="prenomUser">Prénom de l'utilisateur</label>
        @if($user === null)
            <input type="text" name="prenomUser" class="form-control" id="prenomUser" placeholder="Prénom..." value="{{ Auth::user()->prenomUser }}" required>
        @else
            <input type="text" name="prenomUser" class="form-control" id="prenomUser" placeholder="Prénom..." value="{{ $user->prenomUser }}" required>
        @endif
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        @if($user === null)
            <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ Auth::user()->email }}">
        @else
            <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ $user->email }}">
        @endif
    </div>
            <div class="form-group">
                <label for="telUser">Téléphone</label>
                @if($user === null)
                    <input type="tel" name="telUser" class="form-control" id="telUser" placeholder="Téléphone..." value="{{ Auth::user()->telUser }}">
                @else
                    <input type="tel" name="telUser" class="form-control" id="telUser" placeholder="Téléphone..." value="{{ $user->telUser }}">
                @endif
            </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password..." minlength="8">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirmer mot de passe</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Password..." id="password_confirmation">
    </div>

    <div class="form-group">
        @if(Auth::user()->hasRole('admin'))
        <label for="role">Sélectionner un Rôle</label>
        <select class="role form-control" name="role" id="role">
            <option value="">Seclection Rôle...</option>
            @foreach ($roles as $role)
                <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}" {{ $user->roles->isEmpty() || $role->name != $userRole->name ? "" : "selected"}}>{{$role->name}}</option>
            @endforeach
        </select>
        @else
            <label>Role</label>
            <p>
                @if (Auth::user()->roles->isNotEmpty())
                    @foreach (Auth::user()->roles as $role)
                        <span class="badge badge-primary">
                            {{ $role->name }}
                        </span>
                        <input type="hidden" name="role" value="{{ $role->id }}">
                    @endforeach
                @endif
            </p>
        @endif
    </div>
    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Modifier">
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
