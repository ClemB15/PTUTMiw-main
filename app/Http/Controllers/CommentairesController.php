<?php

namespace App\Http\Controllers;

use App\Commentaire;
use App\Commerce;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentairesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $id = Auth::id();
        $user = User::find($id);
        $commerces = Commerce::orderBy('id')->get();
        if($user->roles->first()->slug === 'admin'){
            $commentaires = Commentaire::latest()->get();
        }else{
            $commentaires = Commentaire::where('user_id',$id)
                ->latest()
                ->get();
        }

        return view('admin.commentaires.index', ['commentaires' => $commentaires, 'commerces' => $commerces, 'user' => $user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->filled('codeCom'))
        {
            $request->validate([
                'codeCom' => 'required|max:255'
            ]);
            $codeCom = $request->codeCom;
            $commerce = Commerce::where('codeCom',$codeCom)->first();
            return view('admin.commentaires.create', ['commerce' => $commerce, 'codeCom' => $codeCom]);
        }else{
            return view('admin.commentaires.create');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //validate the categories fields
        $request->validate([
            'note' => 'required|max:255',
            'commentaireAvis'=> 'required',
            'commerce_id' => 'required',
            'codeCommerce' => 'required'
        ]);

        $codeCom = $request->codeCommerce;
        $commerce = Commerce::where('codeCom',$codeCom)->first();

        if ($commerce->id == $request->commerce_id){
            $commentaires = new Commentaire();

            $commentaires->note = $request->note;
            $commentaires->commentaireAvis = $request->commentaireAvis;
            $commentaires->user_id = Auth::id();
            $commentaires->commerce_id = $request->commerce_id;
            $commentaires->created_at = now();
            $commentaires->updated_at = now();
            $commentaires-> save();

        }else{
            abort(403, 'Action interdite.');
        }

        return redirect('/commentaires');
    }

    /**
     * @param Commentaire $commentaire
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Commentaire $commentaire)
    {
        return view('admin.commentaires.show', ['commentaire' => $commentaire]);
    }

    /**
     * @param Commentaire $commentaire
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Commentaire $commentaire)
    {
        return view('admin.commentaires.edit',['commentaire' => $commentaire]);
    }

    /**
     * @param Request $request
     * @param Commentaire $commentaire
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Commentaire $commentaire)
    {

        //validate the categories fields
        $request->validate([
            'note' => 'required|max:255',
            'commentaireAvis'=> 'required'
        ]);

        $commentaire->note = $request->note;
        $commentaire->commentaireAvis = $request->commentaireAvis;
        $commentaire->updated_at = now();
        $commentaire-> save();

        return redirect('/commentaires');
    }

    /**
     * @param Commentaire $commentaire
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();

        return redirect('/commentaires');
    }
}
