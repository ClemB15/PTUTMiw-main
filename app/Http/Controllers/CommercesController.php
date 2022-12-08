<?php


namespace App\Http\Controllers;

use App\Categorie;
use App\Commerce;
use App\Photo;
use App\SousCategorie;
use App\Ville;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommercesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $id = Auth::id();
        $user = User::find($id);
        $photos = Photo::orderBy('id', 'desc')->get();
        if($user->roles->first()->slug === 'responsable-commerce'){
            $commerces = Commerce::where('user_id',$id)
                ->orderBy('id', 'desc')
                ->get();
        }else{
            $commerces = Commerce::orderBy('id', 'desc')->get();
        }

        return view('admin.commerces.index', ['commerces' => $commerces, 'user' => $user, 'photos' => $photos]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Categorie::orderBy('id', 'desc')->get();
        $souscategories = SousCategorie::orderBy('id', 'desc')->get();
        $villes = Ville::orderBy('ville_nom')->get();

        return view('admin.commerces.create', ['categories' => $categories, 'souscategories' => $souscategories, 'villes' => $villes]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $request->validate([
            'nomCom' => 'required|max:255',
            'ad1Com' => 'required|max:255',
            'latCom' => 'required|max:255',
            'longCom' => 'required|max:255',
            'siretCom' => 'required|max:255',
            'telCom' => 'required|max:255',
            'mailCom' => 'required|max:255',
            'siteCom'=> 'max:255',
            'descCom' => 'required|max:255',
            'categorie_id' => 'required',
            'sous_categorie_id' => 'max:255',
            'cheminPhoto'=> 'max:255',
            'descPhoto'=> 'max:255',
            'ville_id' => 'required',
            'horaireLundi' => 'max:255',
            'horaireMardi' => 'max:255',
            'horaireMercredi' => 'max:255',
            'horaireJeudi' => 'max:255',
            'horaireVendredi' => 'max:255',
            'horaireSamedi' => 'max:255',
            'horaireDimanche' => 'max:255'
        ]);

        $ville = Ville::where('ville_nom',$request->ville_id)->first();

        if ($request->horaireLundi === null){
            $request->horaireLundi = "Pas d'horaires";
        }
        if ($request->horaireMardi === null){
            $request->horaireMardi = "Pas d'horaires";
        }
        if ($request->horaireMercredi === null){
            $request->horaireMercredi = "Pas d'horaires";
        }
        if ($request->horaireJeudi === null){
            $request->horaireJeudi = "Pas d'horaires";
        }
        if ($request->horaireVendredi === null){
            $request->horaireVendredi = "Pas d'horaires";
        }
        if ($request->horaireSamedi === null){
            $request->horaireSamedi = "Pas d'horaires";
        }
        if ($request->horaireDimanche === null){
            $request->horaireDimanche = "Pas d'horaires";
        }
        $horaires = Array(
            "Lundi"=> $request->horaireLundi,
            "Mardi"=> $request->horaireMardi,
            "Mercredi"=> $request->horaireMercredi,
            "Jeudi"=> $request->horaireJeudi,
            "Vendredi"=> $request->horaireVendredi,
            "Samedi"=> $request->horaireSamedi,
            "Dimanche"=> $request->horaireDimanche
    );

        $horairesjson = json_encode($horaires);
        $commerces = new Commerce();

        $commerces->nomCom = $request->nomCom;
        $commerces->ad1Com = $request->ad1Com;
        $commerces->latCom = $request->latCom;
        $commerces->longCom = $request->longCom;
        $commerces->siretCom = $request->siretCom;
        $commerces->telCom = $request->telCom;
        $commerces->mailCom = $request->mailCom;
        $commerces->siteCom = $request->siteCom;
        $commerces->descCom = $request->descCom;
        $commerces->horairesCom =$horairesjson;
        $commerces->dateCreaCom = date("Y-m-d\TH:i:s");
        $code = substr(str_replace(' ','',$commerces->nomCom),0,3).date('dmyHi');
        $commerces->codeCom = $code;
        $commerces->etatCom = 0;
        $commerces->categorie_id = $request->categorie_id;
        if (!$request->sous_categorie_id == 0){
            $commerces->sous_categorie_id = $request->sous_categorie_id;
        }
        $commerces->user_id = Auth::user()->id;
        $commerces->ville_id = $ville->id;
        $commerces->save();

        $photos = new Photo();

        if($request->hasfile('cheminPhoto')){
            $file = $request->file('cheminPhoto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/commerces/', $filename);
            $photos->cheminPhoto = $filename;

        } else{
            $photos->cheminPhoto ='';
        }
        $photos->descPhoto = $request['descPhoto'];
        $photos->commerce_id = $commerces->id;
        $photos->save();


        return redirect('/commerces');

    }

    /**
     * @param Commerce $commerce
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Commerce $commerce)
    {
        $categories = Categorie::orderBy('id', 'desc')->get();
        $souscategories = SousCategorie::orderBy('id', 'desc')->get();
        $villes = Ville::orderBy('id', 'desc')->get();
        $id = Auth::id();
        $user = User::find($id);
        $photos = Photo::orderBy('id', 'desc')->get();
        return view('admin.commerces.show', ['commerce' => $commerce,'categories' => $categories, 'souscategories' => $souscategories, 'villes' => $villes, 'user' => $user,'photos'=>$photos]);
    }

    /**
     * @param Commerce $commerce
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Commerce $commerce)
    {
        $categories = Categorie::orderBy('id', 'desc')->get();
        $souscategories = SousCategorie::orderBy('id', 'desc')->get();
        $villes = Ville::orderBy('id', 'desc')->get();
        $photos = Photo::orderBy('id', 'desc')->get();
        return view('admin.commerces.edit', ['commerce' => $commerce,'categories' => $categories, 'souscategories' => $souscategories, 'villes' => $villes,'photos'=>$photos]);
    }

    /**
     * @param Request $request
     * @param Commerce $commerce
     * @param Photo $photo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Commerce $commerce, Photo $photo)
    {

        $request->validate([
            'nomCom' => 'required|max:255',
            'ad1Com' => 'required|max:255',
            'latCom' => 'required|max:255',
            'longCom' => 'required|max:255',
            'siretCom' => 'required|max:255',
            'telCom' => 'required|max:255',
            'mailCom' => 'required|max:255',
            'siteCom'=> 'max:255',
            'descCom' => 'required|max:255',
            'categorie_id' => 'required',
            'sous_categorie_id' => 'max:255',
            'cheminPhoto'=> 'max:255',
            'descPhoto'=> 'max:255',
            'ville_id' => 'required',
            'horaireLundi' => 'max:255',
            'horaireMardi' => 'max:255',
            'horaireMercredi' => 'max:255',
            'horaireJeudi' => 'max:255',
            'horaireVendredi' => 'max:255',
            'horaireSamedi' => 'max:255',
            'horaireDimanche' => 'max:255'
        ]);

        $ville = Ville::where('ville_nom',$request->ville_id)->first();

        if ($request->horaireLundi === null){
            $request->horaireLundi = "Pas d'horaires";
        }
        if ($request->horaireMardi === null){
            $request->horaireMardi = "Pas d'horaires";
        }
        if ($request->horaireMercredi === null){
            $request->horaireMercredi = "Pas d'horaires";
        }
        if ($request->horaireJeudi === null){
            $request->horaireJeudi = "Pas d'horaires";
        }
        if ($request->horaireVendredi === null){
            $request->horaireVendredi = "Pas d'horaires";
        }
        if ($request->horaireSamedi === null){
            $request->horaireSamedi = "Pas d'horaires";
        }
        if ($request->horaireDimanche === null){
            $request->horaireDimanche = "Pas d'horaires";
        }
        $horaires = Array(
            "Lundi"=> $request->horaireLundi,
            "Mardi"=> $request->horaireMardi,
            "Mercredi"=> $request->horaireMercredi,
            "Jeudi"=> $request->horaireJeudi,
            "Vendredi"=> $request->horaireVendredi,
            "Samedi"=> $request->horaireSamedi,
            "Dimanche"=> $request->horaireDimanche
        );

        $horairesjson = json_encode($horaires);


        $commerce->nomCom = $request->nomCom;
        $commerce->ad1Com = $request->ad1Com;
        $commerce->latCom = $request->latCom;
        $commerce->longCom = $request->longCom;
        $commerce->siretCom = $request->siretCom;
        $commerce->telCom = $request->telCom;
        $commerce->mailCom = $request->mailCom;
        $commerce->siteCom = $request->siteCom;
        $commerce->descCom = $request->descCom;
        $commerce->horairesCom =$horairesjson;
        $commerce->etatCom = 0;
        $commerce->categorie_id = $request->categorie_id;
        $commerce->sous_categorie_id = $request->sous_categorie_id;
        $commerce->ville_id = $ville->id;
        $commerce->save();

        if($request->hasfile('cheminPhoto')){
            $file = $request->file('cheminPhoto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/commerces/', $filename);
            $photo->cheminPhoto = $filename;

        }else{
            $image = Photo::where('commerce_id',$commerce->id)->first();
            $photo->cheminPhoto = $image->cheminPhoto;
        }
        $photo->descPhoto = $request['descPhoto'];
        $photo->commerce_id = $commerce->id;
        $photo->update();

        return redirect('/commerces');
    }

    /**
     * @param Commerce $commerce
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Commerce $commerce)
    {
        if ($commerce->etatCom === 0 || $commerce->etatCom === 2){
            $commerce->etatCom = 1;
        }else{
            $commerce->etatCom = 2;
        }

        $commerce->save();

        return redirect('/commerces');
    }
}
