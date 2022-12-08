@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Nom|Prénom: {{Auth::user()->nomUser}} {{Auth::user()->prenomUser}}</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title">Mail</h5>
            <p class="card-text">
                {{Auth::user()->email}}
            </p>
            <h5 class="card-title">Téléphone</h5>
            <p class="card-text">
                @if(Auth::user()->telUser === null)
                    Pas de téléphone enregistré
                @else
                    {{Auth::user()->telUser}}
                @endif
            </p>
            <h5 class="card-title">Crée le</h5>
            <p class="card-text">
                {{strftime('%d-%m-%Y',strtotime(Auth::user()->created_at))}}
            </p>
            <h5 class="card-title">Role</h5>
            <p class="card-text">
                @if (Auth::user()->roles->isNotEmpty())
                    @foreach (Auth::user()->roles as $role)
                        <span class="badge badge-primary">
                            {{ $role->name }}
                        </span>
                    @endforeach
                @endif
            </p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
            <a href="/users/{{ Auth::user()->id }}/edit"><i class="fa fa-edit"></i>Modifier</a>
        </div>
    </div>
</div>

@endsection
