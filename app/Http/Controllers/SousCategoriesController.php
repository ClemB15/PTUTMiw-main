<?php


namespace App\Http\Controllers;

use App\SousCategorie;
use App\Categorie;
use Illuminate\Http\Request;

class SousCategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $souscategories = SousCategorie::orderBy('id', 'desc')->get();

        return view('admin.souscategories.index', ['souscategories' => $souscategories]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Categorie::orderBy('id', 'desc')->get();
        return view('admin.souscategories.create', ['categories' => $categories]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //validate the categories fields
        $request->validate([
            'libSousCat' => 'required|max:255',
            'categorie_id' => 'required'
        ]);

        $souscategories = new SousCategorie();

        $souscategories->libSousCat = $request->libSousCat;
        $souscategories->categorie_id = $request->categorie_id;
        $souscategories->save();


        return redirect('/souscategories');

    }

    /**
     * @param SousCategorie $souscategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(SousCategorie $souscategory)
    {
        return view('admin.souscategories.show', ['souscategorie' => $souscategory]);
    }

    /**
     * @param SousCategorie $souscategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(SousCategorie $souscategory)
    {
        $categories = Categorie::orderBy('id', 'desc')->get();
        return view('admin.souscategories.edit', ['souscategorie' => $souscategory, 'categories' => $categories]);
    }

    /**
     * @param Request $request
     * @param SousCategorie $souscategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, SousCategorie $souscategory)
    {

        $request->validate([
            'libSousCat' => 'required|max:255',
            'categorie_id' => 'required'
        ]);

        $souscategory->libSousCat = $request->libSousCat;
        $souscategory->categorie_id = $request->categorie_id;
        $souscategory->save();

        return redirect('/souscategories');
    }

    /**
     * @param SousCategorie $souscategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(SousCategorie $souscategory)
    {
        $souscategory->delete();

        return redirect('/souscategories');
    }
}
