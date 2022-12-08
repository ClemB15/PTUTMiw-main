<?php

namespace App\Http\Controllers;

use App\Unite;
use Illuminate\Http\Request;

class UnitesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $unites = Unite::orderBy('id', 'desc')->get();

        return view('admin.unites.index', ['unites' => $unites]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.unites.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //validate the categories fields
        $request->validate([
            'libelleUnit' => 'required|max:255'
        ]);

        $unite = new Unite();

        $unite->libelleUnit = $request->libelleUnit;
        $unite-> save();


        return redirect('/unites');

    }

    /**
     * @param Unite $unite
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Unite $unite)
    {
        return view('admin.unites.show', ['unite' => $unite]);
    }

    /**
     * @param Unite $unite
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Unite $unite)
    {
        return view('admin.unites.edit',['unite' => $unite]);
    }

    /**
     * @param Request $request
     * @param Unite $unite
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Unite $unite)
    {

        $request->validate([
            'libelleUnit' => 'required|max:255'
        ]);

        $unite->libelleUnit = $request->libelleUnit;
        $unite-> save();

        return redirect('/unites');
    }

    /**
     * @param Unite $unite
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Unite $unite)
    {
        $unite->delete();

        return redirect('/unites');
    }
}
