<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Reference;
use App\Models\Vehicule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class FiltrageController extends Controller
{
    // public function getviewfilter(){
    //     return view('client.filtrage');
    // }
    // public function getModels(Request $request)
    // {
    //     $marqueId = $request->input('id');
    //     $modeles = Vehicule::where('id', $marqueId)->distinct('modele')->pluck('modele');
    //     $html = '';
    //     foreach ($modeles as $modele) {
    //         $html .= '<button type="button" class="modelButton" data-marque-id="' . $marqueId . '" data-modele="' . $modele . '">' . $modele . '</button>';
    //     }
    //     return $html;
    // }

    // public function getColors(Request $request)
    // {
    //     $marqueId = $request->input('id');
    //     $modele = $request->input('modele');
    //     $couleurs = Vehicule::where('id', $marqueId)
    //                          ->where('modele', $modele)
    //                          ->distinct('couleur')
    //                          ->pluck('couleur');
    //     $html = '';
    //     foreach ($couleurs as $couleur) {
    //         $html .= '<button type="button" class="colorButton" data-marque-id="' . $marqueId . '" data-modele="' . $modele . '" data-couleur="' . $couleur . '">' . $couleur . '</button>';
    //     }
    //     return $html;
    // }

    // public function getReferences(Request $request)
    // {
    //     $marqueId = $request->input('id');
    //     $modele = $request->input('modele');
    //     $couleur = $request->input('couleur');
    //     $references = Vehicule::where('id', $marqueId)
    //                           ->where('modele', $modele)
    //                           ->where('couleur', $couleur)
    //                           ->get();
    //     $html = '';
    //     foreach ($references as $reference) {
    //         $html .= '<button type="button" class="referenceButton" data-marque-id="' . $marqueId . '" data-modele="' . $modele . '" data-couleur="' . $couleur . '" data-reference-id="' . $reference->id . '">' . $reference->reference . '</button>';
    //     }
    //     return $html;
    // }



    public function index()
    {
    
        // $vehicules = Vehicule::all();
        return view('client.filtrage');
    }
    
    
    public function vehicule()
    {
    
        $marques = Vehicule::orderBy('marque_picture', 'asc')->get(); 
        return view('client.vehiculeform',['marques => $marques']);
    }

    public function showdetailsvehicule(Request $request){

        // Récupérer les données du formulaire
    $marque_picture = $request->input("marque_picture");
    $modele_picture = $request->input("modele_picture");
    $imagecolor = $request->input("imagecolor");
    $reference = $request->input("reference");
    $annee = $request["annee"];

    // Trouver la marque associée et augmenter la popularité
    $vehicule = DB::table('vehicules')->where('marque_picture', $marque_picture)->first();

    if ($vehicule) {
        DB::table('vehicules')->where('marque_picture', $marque_picture)->increment('popularity'); // Augmenter la popularité
    }

     
    Log::info("Référence reçue : " . $reference); // Journaliser la référence reçue

    $vehicule = Reference::where('reference', $reference)->first();
    if ($vehicule) {
        Log::info("Véhicule trouvé avec référence : " . $reference);
        $components = $vehicule->components;
        Log::info("Nombre de composants trouvés : " . count($components)); // Nombre de composants récupérés
    } else {
        Log::warning("Aucun véhicule trouvé avec la référence : " . $reference);
        $components = [];
    }

        return view('client.detailsvehicule',[
            'vehicule' => $vehicule, // Transmet le véhicule à la vue
            'components' => $components, // Composants du véhicule
            'marque_picture' => $marque_picture,
            'modele_picture' => $modele_picture,
            'imagecolor' => $imagecolor,
            'reference' => $reference,
            'annee' => $annee,
        ]);

    }


  


}


