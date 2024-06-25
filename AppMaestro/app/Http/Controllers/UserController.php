<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vehicule;
use App\Models\Color;
use App\Models\Reference;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $products = Product::all();
        $LatestEvents = Event::limit(5)->where('status', 'Public')->get();
        $events = Event::where('status', 'Public')->paginate(6);

        return view('welcome', compact('categories', 'LatestEvents', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function statistic()
    {
        $creator = Auth::user();
        $totalProducts = Vehicule::where('creator', $creator->id)->count();
        // $products = Product::all();
        $vehicules = Vehicule::all();
        $couleurs = Color::all();
        $references = Reference::all();
        

        // $publicEvents = Event::where('creator', $creator->id)
        //     ->where('status', 'Public')->count();
        $LatestProducts = Vehicule::limit(3)->where('creator', $creator->id)->get();

//        dd($totalEvents);

        return view('creator.dashboard', compact('totalProducts','LatestProducts','vehicules','couleurs','references'));
    }

    
    public function dashboard()
    {
        $admin = Auth::user();
        $totalUsers = User::all()->count();
        // $totalCategories = Category::all()->count();

        // $publicEvents = Event::all()
        //     ->where('status', 'Public')->count();
        // $LatestEvents = Event::limit(5)->get();
        $LatestUsers = User::limit(5)->get();
        $creatorRole = Role::where('name', 'creator')->first();
        $LatestCreator = $creatorRole->users()->orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('admin', 'totalUsers', 'LatestUsers', 'LatestCreator'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $users = User::paginate(4);
        $roles = Role::all();
        return view('admin.allusers', compact('users', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required'
        ]);
        $role = Role::find($request->role);
        $user = User::find($id);

        $user->syncRoles($role->name);

        return redirect('/allusers')->with('success', 'Role Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');

    }

    public function restoreUser($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return redirect()->back()->with('success', 'User restored successfully!');

    }

    public function showDeletedUsers()
    {
        $users = User::onlyTrashed()->get();

        return view('admin.deletedUsers', compact('users'));
}
}
