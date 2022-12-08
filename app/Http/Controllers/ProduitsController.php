<?php


namespace App\Http\Controllers;

use App\Commerce;
use App\Produit;
use App\Unite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduitsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $id = Auth::id();
        $user = User::find($id);
        $unites = Unite::orderBy('id', 'desc')->get();
        $commerces = Commerce::orderBy('id', 'desc')->get();
        if($user->roles->first()->slug === 'responsable-commerce'){
            $produits = Produit::orderBy('id', 'desc')->get();
        }else{
            $produits = Produit::orderBy('id', 'desc')->get();
        }

        return view('admin.produits.index', ['produits' => $produits, 'user' => $user, 'unites' => $unites, 'commerces'=>$commerces]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $id = Auth::id();
        $user = User::find($id);
        $unites = Unite::orderBy('id', 'desc')->get();
        if($user->roles->first()->slug === 'responsable-commerce'){
            $commerces = Commerce::where('user_id',$id)
                ->orderBy('id', 'desc')
                ->get();
        }else{
            $commerces = Commerce::orderBy('id', 'desc')->get();
        }


        return view('admin.produits.create', ['unites' => $unites, 'commerces' => $commerces]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $request->validate([
            'labelProd' => 'required|max:255',
            'descProd' => 'required|max:255',
            'prixProd' => 'required|max:255',
            'cheminPhotoProd' => 'required|max:255',
            'quantiteProd' => 'required|max:255',
            'unite_id' => 'required',
            'commerce_id' => 'max:255'
        ]);

        $produits = new Produit();

        $produits->labelProd = $request->labelProd;
        $produits->descProd = $request->descProd;
        $produits->prixProd = $request->prixProd;
        if($request->hasfile('cheminPhotoProd')){
            $file = $request->file('cheminPhotoProd');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/produits/', $filename);
            $produits->cheminPhotoProd = $filename;
        } else{
            $produits->cheminPhotoProd ='';
        }
        $produits->quantiteProd = $request->quantiteProd;
        $produits->unite_id = $request->unite_id;
        $produits->commerce_id = $request->commerce_id;

        $produits->save();


        return redirect('/produits');

    }

    /**
     * @param Produit $produit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Produit $produit)
    {
        $unites = Unite::orderBy('id', 'desc')->get();
        $commerces = Commerce::orderBy('id', 'desc')->get();
        return view('admin.produits.show', ['produit' => $produit,'unites' => $unites, 'commerces' => $commerces]);
    }

    /**
     * @param Produit $produit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Produit $produit)
    {
        $id = Auth::id();
        $user = User::find($id);
        $unites = Unite::orderBy('id', 'desc')->get();
        if($user->roles->first()->slug === 'responsable-commerce'){
            $commerces = Commerce::where('user_id',$id)
                ->orderBy('id', 'desc')
                ->get();
        }else{
            $commerces = Commerce::orderBy('id', 'desc')->get();
        }


        return view('admin.produits.edit', ['produit'=> $produit, 'unites' => $unites, 'commerces' => $commerces]);
    }

    /**
     * @param Request $request
     * @param Produit $produit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Produit $produit)
    {

        $request->validate([
            'labelProd' => 'required|max:255',
            'descProd' => 'required|max:255',
            'prixProd' => 'required|max:255',
            'cheminPhotoProd' => 'max:255',
            'quantiteProd' => 'required|max:255',
            'unite_id' => 'required',
            'commerce_id' => 'max:255'
        ]);

        $produit->labelProd = $request->labelProd;
        $produit->descProd = $request->descProd;
        $produit->prixProd = $request->prixProd;
        if($request->hasfile('cheminPhotoProd')){
            $file = $request->file('cheminPhotoProd');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/produits/', $filename);
            $produit->cheminPhotoProd = $filename;
        }
        $produit->quantiteProd = $request->quantiteProd;
        $produit->unite_id = $request->unite_id;
        $produit->commerce_id = $request->commerce_id;

        $produit->save();


        return redirect('/produits');
    }

    /**
     * @param Produit $produit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();

        return redirect('/produits');
    }
}
