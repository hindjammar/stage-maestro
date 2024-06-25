<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Reference;
use App\Models\Vehicule;
use App\Models\Color;



class ClientController extends Controller
{
    public function client()
    {
        return view('admin.home');
    }
    public function traiterClicSurBouton(Request $request)
{
    if (Auth::check()) {
        // L'utilisateur est authentifié, renvoyer la vue affichereferences avec les références
        $references = Reference::all();
        return view('client.references', compact('references'));
    } else {
        // L'utilisateur n'est pas authentifié, rediriger vers la page de connexion avec les références en tant que données
        $references = Reference::all();
        return redirect()->route('register')->with('redirectUrl', route('refcolors'))->with('references', $references);
    }
}
    public function afficherProfil()
    {
        // Récupérer l'utilisateur authentifié
        $utilisateur = Auth::user();

        // Afficher la vue du profil avec les détails de l'utilisateur
        return view('client.profil', compact('utilisateur'));
    }


    public function showDetails($id)
    {
        // Récupérer la référence correspondant à l'ID
        // $references = Reference::find($id);
        $references = Reference::with('color','components')->find($id); // Chargez la relation avec 'with'


        // Vérifier si la référence existe
        if (!$references) {
            // Rediriger ou afficher une erreur si la référence n'est pas trouvée
            return redirect()->back()->with('error', 'Référence non trouvée.');
        }

        

        // Afficher les détails de la référence dans une vue
        return view('client.details', ['references' => $references]);
    }
    

    function affichenav(){
        return view('nav');
    }

}
