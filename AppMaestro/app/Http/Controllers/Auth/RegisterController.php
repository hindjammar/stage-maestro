<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    if (User::count() === 1) {
        // Si c'est le premier utilisateur, lui attribuer le rôle d'administrateur
        $user->assignRole('admin');
    } elseif (User::count() === 2) {
        // Si c'est le deuxième utilisateur, lui attribuer le rôle de créateur
        $user->assignRole('creator');
    } else {
        // Sinon, attribuer le rôle de client
        $user->assignRole('client');
    }

    return $user;

}

protected function redirectTo()
{
    if (auth()->user()->hasRole('admin')) {
        return '/dashboardadmin';
    } elseif (auth()->user()->hasRole('creator')) {
        return '/dashboard';
    } elseif (auth()->user()->hasRole('client')) {
        return '/refcolors';
    } else {
        // Redirection par défaut si l'utilisateur n'a aucun rôle défini
        return '/welcome';
    }
}
}
