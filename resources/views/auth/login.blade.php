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
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">

                                <div class="col-md-6 input-control">
                                    <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>


                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row ">

                                <div class="col-md-6 input-control">
                                    <input placeholder="Mot de passe" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Se souvenir') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="buttons-container">
                                    <button type="submit" class="btn btn-primary buttons button-login ">
                                        {{ __('Connexion') }}
                                    </button>

                                    <p>
                                        <!-- Lien de redirection vers Google -->
                                        <a href="{{ route('socialite.redirect', 'google') }}" title="Connexion avec Google" class="btn btn-primary buttons buttons-google"  ><img src="{{ asset('/images/google.png') }}" class="rounded" alt="google" width="30px"> Connexion avec Google</a>
                                    </p>
                                    @if (Route::has('register'))
                                        <p>
                                            <a class="btn btn-primary buttons button-login" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
