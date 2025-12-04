<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wilaya; // Import du modèle Wilaya nécessaire
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // On récupère toutes les wilayas pour les afficher dans le select
        // Assurez-vous que le modèle Wilaya existe bien dans App\Models\Wilaya
        $wilayas = Wilaya::all();

        // On passe la variable $wilayas à la vue 'auth.register'
        return view('auth.register', compact('wilayas'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Vous pouvez ajouter ici la validation pour wilaya_id, daira_id, etc.
            // 'wilaya_id' => ['required', 'exists:wilayas,id'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Si vous avez ajouté les colonnes dans votre migration users table, décommentez ceci :
            // 'wilaya_id' => $request->wilaya_id,
            // 'daira_id' => $request->daira_id,
            // 'commune_id' => $request->commune_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}