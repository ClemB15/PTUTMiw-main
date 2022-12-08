@extends("layouts.app")
@section("content")
    <div class="container">
        <h1>Se connecter / S'enregistrer avec un compte social</h1>
        <p>
            <!-- Lien de redirection vers Google -->
            <a href="{{ route('socialite.redirect', 'google') }}" title="Connexion/Inscription avec Google" class="btn btn-link"  >Continuer avec Google</a>
        </p>
    </div>
@endsection
