<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\HelloMail;
use Illuminate\Support\Facades\Mail; // Add this line to import the Mail facade


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users=User::all();
        return view('admin.home',compact('users'));
    }

    public function allusers()
    {
        $users=User::all();
        return view('admin.liste_users',compact('users'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'adresse' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'specialite' => 'nullable|string|max:255',
            'role' => 'required',
        ]);
    
        // Création de l'utilisateur avec le mot de passe hashé
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), 
            'adresse' => $validatedData['adresse'],
            'phone' => $validatedData['phone'],
            'specialite' => $validatedData['specialite'],
            'role' => $validatedData['role'],
        ]);
    
        if ($user) {
            try {
                Mail::to($user->email)->send(new HelloMail($user, $validatedData['password']));
                return redirect()->back()->with('success', 'Utilisateur ajouté avec succès et e-mail envoyé !');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Utilisateur ajouté, mais l\'e-mail n\'a pas pu être envoyé. Erreur : ' . $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'Utilisateur non ajouté !');
        }
    }
    


    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    if ($request->input('password')) {
        $user->password = bcrypt($request->input('password'));
    }
    $user->adresse = $request->input('adresse');
    $user->phone = $request->input('phone');
    $user->specialite = $request->input('specialite');
    $user->role = $request->input('role');

    $user->save();

    if ($user) {

        session()->flash('success', 'User added successfully!');
    } else {
        session()->flash('error', 'Failed to add user!');
    }

    return redirect()->back()->with('success', 'Utilisateur mis à jour avec succès');
}

public function destroy($id)
{
    $user = User::find($id);
    if ($user) {
        $user->delete();
        return redirect()->back()->with('success', 'Utilisateur supprimé avec succès.');
    } else {
        return redirect()->back()->with('error', 'Utilisateur non trouvé.');
    }
}



}
