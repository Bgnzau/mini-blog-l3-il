<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User; // Ne pas oublier d'importer le modèle User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Pour sécuriser les mots de passe

class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs (avec recherche et pagination).
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Si une recherche est soumise depuis la toolbar
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Récupère 15 utilisateurs par page, triés du plus récent au plus ancien
        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        // On retourne la vue (dans resources/views/users.blade.php ou resources/views/users/index.blade.php selon ton organisation)
        // Si ton fichier blade s'appelle juste "users.blade.php", laisse 'users'
        return view('users', compact('users'));
    }

    /**
     * Pas besoin de cette méthode car le formulaire est intégré dans un Modal sur la page index.
     */
    public function create()
    {
        return redirect()->route('users.index');
    }

    /**
     * Enregistrer un nouvel utilisateur dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Création de l'utilisateur
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // On hache le mot de passe !
            'email_verified_at' => $request->has('email_verified') ? now() : null,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès !');
    }

    /**
     * Afficher un utilisateur spécifique (non utilisé ici).
     */
    public function show(string $id)
    {
        return redirect()->route('users.index');
    }

    /**
     * Pas besoin de cette méthode car le formulaire de modification est aussi dans un Modal.
     */
    public function edit(string $id)
    {
        return redirect()->route('users.index');
    }

    /**
     * Mettre à jour l'utilisateur spécifié dans la base de données.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validation (on ignore l'email de l'utilisateur actuel pour éviter l'erreur "déjà pris")
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // Optionnel pour la modification
        ]);

        // Mise à jour des champs de base
        $user->name = $request->name;
        $user->email = $request->email;

        // On ne change le mot de passe que si un nouveau a été saisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès !');
    }

    /**
     * Supprimer l'utilisateur de la base de données.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès !');
    }
}