<?php

namespace App\Http\Controllers;

use App\Commentaire;
use App\Commerce;
use App\Consultation;
use App\Produit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        if($user->roles->first()->slug === 'responsable-commerce' || $user->roles->first()->slug === 'admin'){
            if ($request->filled('commerce_id')) {
                $request->validate([
                    'commerce_id' => 'required'
                ]);
                $commerces = Commerce::where('user_id',$id)
                    ->orderBy('id')
                    ->get();
                $commerce_id = $request->commerce_id;
                $commerce = Commerce::where('id',$commerce_id)->first();
                $consultations = Consultation::where('commerce_id',$commerce->id)
                    ->orderBy('dateConsultation', 'desc')
                    ->get();
                $commentaires = Commentaire::where('commerce_id',$commerce->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
                $notes = Commentaire::where('commerce_id',$commerce->id)
                    ->avg('note');
                $produits = Produit::where('commerce_id', $commerce->id)
                    ->orderBy('id','desc')
                    ->get();
                return view('admin.index', ['commerces' => $commerces,'comm' => $commerce, 'user' => $user, 'consultations' => $consultations,'commentaires' => $commentaires, 'notes'=> $notes, 'produits'=> $produits]);

            }else{
                $commerces = Commerce::where('user_id',$id)
                    ->orderBy('id')
                    ->get();
               if (count($commerces) == 1){
                        $commerce = Commerce::where('id', $commerces[0]->id)->first();
                        $consultations = Consultation::where('commerce_id',$commerce->id)
                            ->orderBy('dateConsultation', 'desc')
                            ->get();
                        $commentaires = Commentaire::where('commerce_id',$commerce->id)
                            ->orderBy('created_at', 'desc')
                            ->get();
                        $notes = Commentaire::where('commerce_id',$commerce->id)
                            ->avg('note');
                        $produits = Produit::where('commerce_id', $commerce->id)
                            ->orderBy('id','desc')
                            ->get();
                }else{
                    $consultations = [];
                    $commentaires =[];
                    $notes = '';
                    $produits = [];
                    $commerce = '';
                }

                return view('admin.index', ['commerces' => $commerces, 'comm' => $commerce,'user' => $user, 'consultations' => $consultations,'commentaires' => $commentaires, 'notes'=> $notes, 'produits'=> $produits]);

            }
        }else{
            $commerces = '';
            return view('admin.index', ['commerces' => $commerces, 'user' => $user]);
        }
    }
}
