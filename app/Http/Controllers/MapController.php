<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Commerce;
use App\Consultation;
use App\Http\Controllers\Controller;
use App\SousCategorie;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class MapController extends Controller
{

    public function index (Request $request){
   
        // quand c'est une requette ajax
        if ($request->ajax()) {
            if (isset($_POST["northWest"]) && isset($_POST["southEast"])) {

                // recuperation des magasin qui sont dans la zone que la carte selectionne actuelement
                $northWest = $_POST["northWest"];
                $southEast = $_POST["southEast"];
                
                $commercesInBetween = Commerce::commercesInBetween($northWest,  $southEast)->where('etatCom', '1');
                
                $idCat = $commercesInBetween->distinct()->get('categorie_id');
                $idSousCat = $commercesInBetween->distinct()->get('sous_categorie_id');
                
                // recuperation des categories et sous categories pour lesquelles il y  a des commerces référencés dasn la zone actuelle de la carte
                $currentCategories = Categorie::whereIn('id', $idCat)->orderBy('libCat', 'asc')->get();
                $currentSousCategories = SousCategorie::whereIn('id', $idSousCat)->orderBy('libSousCat', 'asc')->get();
                
                // recuperation des chemins des photos des magasins selectionnées               
                $currentPhotosCom = Photo::whereIn('commerce_id', $commercesInBetween->get('id'))->get();

                $response = [
                    'currentCommerces'      => $commercesInBetween->get(),
                    'currentCategories'     => $currentCategories,
                    'currentSousCategories' => $currentSousCategories,
                    'currentPhotosCom'      => $currentPhotosCom
                ];
                return $response;
                
            }else if(isset($_POST["clicked"])){
                // ajout en bas e d'un nouveau clic pour ce commerce
                $commerce_id = intval($_POST["clicked"]);
                $date = date("Y-m-d\TH:i:s");

                DB::table('consultations')->insert(
                [
                    'commerce_id' => $commerce_id,
                    'dateConsultation' => $date
                ]);
                return;
            }else if(isset($_POST["commerce_id"])){
                // recherche et renvoie les produit (et des unitées correspondantes) du commerce
                $commerce_id = intval($_POST["commerce_id"]);

                $produits = DB::table('produits')->join('unites', 'produits.unite_id', '=', 'unites.id')
                                ->where('commerce_id', $commerce_id)
                                ->select('produits.id', 'labelProd', 'descProd', 'prixProd', 'cheminPhotoProd', 'quantiteProd', 'unite_id', 'commerce_id', 'libelleUnit')
                                ->orderBy('labelProd', 'asc')
                                ->get();

                $commentaires = DB::table('commentaires')
                                ->where('commerce_id', $commerce_id)
                                ->get();

                return [
                    'produits'      => $produits,
                    'commentaires'   => $commentaires
                ];

            }else {
                abort(404);
            }
        }
       
        
        return view('map');
    }

}
