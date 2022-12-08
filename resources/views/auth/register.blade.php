@extends('layouts.baseLogin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (Route::has('map'))
                    <div class="logo">
                        <a href="{{route('map')}}">
                            <img src="images/logos/logoBaluchonVert.png">
                        </a>
                    </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-6 input-control">
                                <input placeholder="Nom" id="nomUser" type="text" class="form-control @error('nomUser') is-invalid @enderror" name="nomUser" value="{{ old('nomUser') }}" required autocomplete="nomUser" autofocus>

                                @error('nomUser')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 input-control">
                                <input placeholder="Prenom" id="prenomUser" type="text" class="form-control @error('prenomUser') is-invalid @enderror" name="prenomUser" value="{{ old('prenomUser') }}" required autocomplete="prenomUser" autofocus>

                                @error('prenomUser')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 input-control">
                                <input placeholder="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 input-control">
                                <input placeholder="Mot de passe" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 input-control">
                                <input placeholder="Confirmation du mot de passe" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Êtes-vous un Internaute ou un Responsable Commerce ?') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control" name="role" required>
                                    <option value="user">Internaute</option>
                                    <option value="resp">Responsable Commerce</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="buttons-container">
                                <button type="submit" class="btn btn-primary buttons button-login">
                                    {{ __('S\'inscrire') }}
                                </button>
                                <p>
                                    <!-- Lien de redirection vers Google -->
                                    <a href="{{ route('socialite.redirect', 'google') }}" title="Inscription avec Google" class="btn btn-primary buttons buttons-google"><img src="{{ asset('/images/google.png') }}" class="rounded" alt="google" width="30px"> S'inscrire avec Google</a>
                                </p>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
