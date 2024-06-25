<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Reference;
use App\Models\Color;

use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $references=Reference::all();
        return view('creator.reference',compact('references'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors=Color::all();
        return view('creator.color', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference'=>'required|unique:references,reference',
            'couleur'=>'required',
            'imagereference'=>'required|image'
          ]);
      
          if ($request->hasFile('imagereference')) {
              $fileName = $request->file('imagereference')->getClientOriginalName();
              $path = $request->file('imagereference')->storeAs('imagereference', $fileName, 'public');
              $picturePath = Storage::url($path); // Utilisation de Storage::url() pour obtenir l'URL publique
          } else {
              $picturePath = null;
          }

          Reference::create([
              'reference'=> $request->reference,
              'couleur'=> $request->couleur,
              'imagereference' => $picturePath,
          ]);
      return redirect('/colors');
    }

    /**
     * Display the specified resource.
     */
    public function afficheReference()
    {
        // $references=Reference::all();
        // return view('client.references',compact('references'));
        $references = Reference::orderBy('popularity', 'desc')->get(); // Trier par popularité décroissante
    return view('client.references', compact('references'));

    }


    public function cliquerSurReference(Request $request) {
        $referenceId = $request->input('reference'); // Récupérer l'ID de la référence cliquée

        if ($referenceId) {
            // Incrémenter la popularité de la référence
            Reference::where('id', $referenceId)->increment('popularity');
        }

        return response()->json(['message' => 'Popularité mise à jour']); // Réponse pour AJAX
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(odel $odel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, odel $odel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(odel $odel)
    {
        //
    }
}
