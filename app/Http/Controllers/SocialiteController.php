<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // Les tableaux des providers autorisés
    protected $providers = ["google", "github", "facebook"];

    # redirection vers le provider
    public function redirect(Request $request)
    {

        $provider = $request->provider;

        // On vérifie si le provider est autorisé
        if (in_array($provider, $this->providers)) {
            return Socialite::driver($provider)->redirect(); // On redirige vers le provider
        }
        abort(404); // Si le provider n'est pas autorisé
    }

    // Callback du provider
    public function callback(Request $request)
    {

        $provider = $request->provider;

        if (in_array($provider, $this->providers)) {

            // Les informations provenant du provider
            $data = Socialite::driver($request->provider)->user();

            # Social login - register

            $email = $data->getEmail(); // L'adresse email
            $name = $data->getName(); // le nom
            $nom = explode(' ', $name);

            # 1. On récupère l'utilisateur à partir de l'adresse email
            $user = User::where("email", $email)->first();

            # 2. Si l'utilisateur existe
            if (isset($user)) {

                // Mise à jour des informations de l'utilisateur
                $user->nomUser = $nom[1];
                $user->prenomUser = $nom[0];
                $user->save();

                # 3. Si l'utilisateur n'existe pas, on l'enregistre
            } else {

                // Enregistrement de l'utilisateur
                $user = User::create([
                    'nomUser' => $nom[1],
                    'prenomUser' => $nom[0],
                    'email' => $email,
                    'password' => bcrypt("baluchon") // On attribue un mot de passe
                ]);
                $user->roles()->attach(4);
                $user->save();
            }

            # 4. On connecte l'utilisateur
            auth()->login($user);

            # 5. On redirige l'utilisateur vers /home
            if (auth()->check()) return redirect(route('profile'));

        }
        abort(404);
    }

}
