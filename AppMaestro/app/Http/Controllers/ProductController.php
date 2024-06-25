<?php

namespace App\Http\Controllers;

use App\Mail\NewEventNotification;
// use App\Models\Category;
use App\Models\User;
use App\Models\Color;
use App\Models\Reference;
use App\Models\Product;
use App\Models\Component;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showForm()
    {
        $references= Reference::all();
        
        return view('creator.createProduct',compact('references'));
    }
    
    // public function showDashboardcreator($id){
    //     $products = Product::with(['marque', 'modele', 'couleur', 'reference'])->find($id);
    //     return view('creator.dashboard',compact('products'));
    // }

    public function vehicules(Request $request){
        $vehicules = Vehicule::with('reference')->simplePaginate(10); // 10 éléments par page
        // $vehicules = Vehicule::with('reference')->get(); // Charger la relation 'reference'
        $references = Reference::with('vehicules')->get(); // Charger la relation "components"

        return view('admin.products', compact('vehicules','references'));

    }

    //my events
    public function AllEvents()
    {
        $user = Auth::user()->id;

        $products = Product::all()->where('creator', $user);

        return view('creator.allProducts', compact('products'));
    }

    public function CheckEvent()
    {
        $events = Vehicule::where('status', 'En attente')->get();

        return view('admin.products', compact('events'));
    }

    public function ShowEventDescription($id)
    {
        $event = Event::find($id);
        return view('organiser.description', compact('event'));
    }

    public function EventContent($id)
    {
//        $event = Event::with('category')->find($id);
        $event = Event::find($id);
        $userRole = "organizer";

        return view('content', compact('event', 'userRole'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'reference' => 'required|string',
            'component_name' => 'required|array', // Validation pour les composants
            'component_name.*' => 'required|string', // Chaque composant doit être une chaîne
            'component_quantity' => 'required|array',
            'component_quantity.*' => 'required|integer|min:0|max:1000', // Chaque quantité doit être un entier
            'component_unit' => 'required|array',
            'component_unit.*' => 'required|string', // Chaque unité doit être une chaîne
        ]);

          // Récupérer la référence
    $reference = $request->input('reference'); // ID de la référence sélectionnée

    // Traitement des composants
    $componentNames = $request->input('component_name');
    $componentQuantities = $request->input('component_quantity');
    $componentUnits = $request->input('component_unit');

    foreach ($componentNames as $index => $name) {
        $quantity = $componentQuantities[$index];
        $unit = $componentUnits[$index];

        // if ($quantity > 1000) { // Assure que la quantité ne dépasse pas 1000, peu importe l'unité
        //     return redirect()->back()->with('error', 'La quantité ne peut pas dépasser 1000 unités.');
        // }
         // Vérification des quantités
    foreach ($request->input('component_quantity') as $quantity) {
        if ($quantity > 1000) {
            return redirect('/createComponent')->with('error', 'La quantité ne peut pas dépasser 1000.');
        }
    }


        // Créer un nouveau composant
        Component::create([
            'reference' => $reference, // Associer au champ 'reference'
            'name' => $name, // Nom du composant
            'quantity' => $quantity, // Quantité
            'unit' => $unit, // Unité
        ]);
    }
        
        // $this->sendEmailToAdmin($user);

        return redirect('/createComponent')->with('success', 'Composants ajoutés avec succès.');;
    }


    private function sendEmailToAdmin()
    {
        $user = Auth::user()->name;

        $adminRole = Role::where('name', 'admin')->first();

        if ($adminRole) {
            $admins = $adminRole->users;

            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new NewEventNotification($user));
            }
        }
    }


    /**
     * Display the specified resource.
     */
    public function editEvent($id)
    {
        $content = file_get_contents('https://raw.githubusercontent.com/alaouy/sql-moroccan-cities/master/json/ville.json');
        $data = json_decode($content);

        $categories = Category::all();

        $event = Event::find($id);

        return view('organiser.updateEvent', compact('event', 'data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateEvent(Request $request, $id)
    {
        $user = Auth::id();
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'price' => 'required',
            'date' => 'required',
            'time' => 'required',
            'description' => 'required',
            'reservation_type' => 'required',
            'image' => 'required|image',
            'category' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('image', $fileName, 'public');
            $picturePath = Storage::url($path);
        } else {
            $picturePath = null;
        }

        $event->title = $request['title'];
        $event->location = $request['location'];
        $event->date = $request['date'];
        $event->time = $request['time'];
        $event->price = $request['price'];
        $event->nbr_place = $request['nbr_place'];
        $event->description = $request['description'];
        $event->reservation_type = $request['reservation_type'];
        $event->image = $picturePath;
        $event->creator = $user;
        $event->category = $request['category'];

        $event->save();
        return redirect('/allEvents');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteEvent(string $id)
    {
        $event = Vehicule::findOrFail($id);
        $event->delete();

        return redirect('/allEvents');
    }

    public function approveEvent($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        $vehicule->status = 'Public';
        $vehicule->save();

        return redirect()->back()->with('message', 'Véhicule approuvé avec succès.');
    }

    public function declineEvent($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        $vehicule->status = 'Decline';
        $vehicule->save();

        return redirect()->back()->with('message', 'Véhicule refusé avec succès.');
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $LatestEvents = Event::limit(5)->where('status', 'Public')->get();

        $searchTerm = $request->input('search');

        $events = Event::where('status', 'Public')
            ->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('location', 'like', '%' . $searchTerm . '%');
            })
            ->paginate(6);

        return view('welcome', compact('events', 'categories', 'LatestEvents'));
    }


    public function filterByCategory($categoryName)
    {
        $categories = Category::all();
        $LatestEvents = Event::limit(5)->where('status', 'Public')->get();

        $category = Category::where('name', $categoryName)->firstOrFail();

        $events = Event::where('category', $category->id)
            ->where('status', 'Public')->paginate(6);

        //dd($events);
        return view('welcome', compact('events', 'categories', 'LatestEvents'));
}

public function index(){
    $colors=Color::all();
    $references= Reference::all();
    return view('creator.vehicule',compact('colors','references'));
}

public function storevehicule(Request $request){
    $user = Auth::id();

    $request->validate([
        'marque' => 'required',
        'modele' => 'required',
        'marque_picture' => 'required|image',
        'modele_picture' => 'required|image',
        'couleur' => 'required',
        'reference' => 'required',
        'annee' => 'required',
       
        ]);
       
    if ($request->hasFile('marque_picture')) {
        $fileName = time() . $request->file('marque_picture')->getClientOriginalName();
        $path = $request->file('marque_picture')->storeAs('marque_picture', $fileName, 'public');
        $marquepicturePath = Storage::url($path);
    } else {
        $marquepicturePath = null;
    }


    if ($request->hasFile('modele_picture')) {
        $fileName = time() . $request->file('modele_picture')->getClientOriginalName();
        $path = $request->file('modele_picture')->storeAs('modele_picture', $fileName, 'public');
        $modelepicturePath = Storage::url($path);
    } else {
        $modelepicturePath = null;
    }

    $vehicule = Vehicule::create([
        'marque' => $request->marque,
        'modele' => $request->modele,
        'couleur' => $request->couleur,
        'reference' => $request->reference,
        'annee' => $request->annee,
        'marque_picture' => $marquepicturePath,
        'modele_picture' => $modelepicturePath,
        'creator' => $user,
        'status' => 'En attente',

    ]);

  
     $this->sendEmailToAdmin($user);

    return redirect('/dashboard');
}

    public function notification(){
        return view('emails.approve-event_notification');
    }
}
