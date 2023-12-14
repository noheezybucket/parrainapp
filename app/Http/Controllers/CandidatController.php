<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;

class CandidatController extends Controller
{
    function index()
    {
        return view('candidats/list', ['candidats' => Candidat::all()]);
    }

    function create()
    {
        return view('candidats/create');
    }

    function create_candidate(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'partie' => 'required',
            'biographie' => 'required',
            'validate' => 'required',

        ]);

        $candidat = new Candidat();

        $candidat->nom = $request->nom;
        $candidat->prenom = $request->prenom;
        $candidat->partie = $request->partie;
        $candidat->biographie = $request->biographie;
        $candidat->validate = $request->validate;
        $candidat->photo = "mike";

        $candidat->save();

        return redirect('candidats/create')->with('status', 'Candidat ajouté avec succès!');
    }

    function read($id)
    {
        $candidat = Candidat::find($id);
        return view('candidats/read', ['candidat' => $candidat]);
    }


    function update($id)
    {
        $candidat = Candidat::find($id);
        return view('candidats/update', ['candidat' => $candidat]);
    }

    function update_candidate(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'partie' => 'required',
            'biographie' => 'required',
            'validate' => 'required',

        ]);

        $candidat = Candidat::find($request->id);

        $candidat->nom = $request->nom;
        $candidat->prenom = $request->prenom;
        $candidat->partie = $request->partie;
        $candidat->biographie = $request->biographie;
        $candidat->validate = $request->validate;
        $candidat->photo = $request->nom;

        $candidat->update();

        return redirect('candidats/update/' . $request->id)->with('status', 'Candidat modifié avec succès!');
    }
}