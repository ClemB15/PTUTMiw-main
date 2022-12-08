<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Categorie::orderBy('id', 'desc')->get();

        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //validate the categories fields
        $request->validate([
            'libCat' => 'required|max:255',
            'cheminMarkerCat' => 'max:255'
        ]);

        $url = strrchr(substr($request->cheminMarkerCat, 0,-15),'"');
        $cheminMarketCat = substr(substr($url,18),0,-4);

        $categorie = new Categorie();

        $categorie->libCat = $request->libCat;
        $categorie->cheminMarkerCat = $cheminMarketCat;
        $categorie-> save();


        return redirect('/categories');

    }

    /**
     * @param Categorie $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Categorie $category)
    {
        return view('admin.categories.show', ['categorie' => $category]);
    }

    /**
     * @param Categorie $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Categorie $category)
    {
        return view('admin.categories.edit',['categorie' => $category]);
    }

    /**
     * @param Request $request
     * @param Categorie $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Categorie $category)
    {

        $request->validate([
            'libCat' => 'required|max:255',
            'cheminMarkerCat' => 'max:255'
        ]);

        $url = strrchr(substr($request->cheminMarkerCat, 0,-15),'"');
        $cheminMarketCat = substr(substr($url,18),0,-4);

        $category->libCat = $request->libCat;
        $category->cheminMarkerCat = $cheminMarketCat;
        $category->save();

        return redirect('/categories');
    }

    /**
     * @param Categorie $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Categorie $category)
    {
        $category->delete();

        return redirect('/categories');
    }
}
