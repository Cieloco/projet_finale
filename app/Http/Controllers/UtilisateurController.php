<?php

namespace App\Http\Controllers; 

use App\Http\Requests\UtilisateurRequest;
use App\Http\Requests\UtilisateurRequestUp;
use App\Mail\PasswordReacaputilation;
use App\Mail\UserVerification;
use App\Models\Service;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UtilisateurController extends Controller
{

    private function permission() {
        if(auth()->check()) {
            $user = auth()->user();
            if (!($user->role === 'admin')) {
                abort(403, 'Only Admin allowed to make this operation');
            }
        }
    }
    private function authorization($user) {
        if(auth()->check()) {
            $utilisateur = auth()->user();
            if (($utilisateur->role === 'fonctionnaire' && !($utilisateur->id === $user->id)) || !($utilisateur->service_id === $user->service_id) && !($utilisateur->role === 'directeur')) {
                abort(403);
            }
        }
    }
    private function gate($user) {
        if(auth()->check()) {
            $utilisateur = auth()->user();
            if (!($utilisateur->id === $user->id) && !($utilisateur->role === 'admin')) {
                abort(403);
            }
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $this->permission();
    
    $query = Utilisateur::whereIn('role', ['directeur', 'chef', 'fonctionnaire']);
    
    if ($request->filled('role')) {
        $query->where('role', $request->role);
    }
    
    $users = $query->get()->sortBy(function ($user) {
        switch ($user->role) {
            case 'directeur':
                return 1;
            case 'chef':
                return 2;
            case 'fonctionnaire':
                return 3;
            default:
                return 4; // For any other roles not listed above
        }
    });

    return view('admin.index.user', compact('users'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->permission();
        $services = Service::all();
        return view('admin.create.user', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(UtilisateurRequest $request) 
    {
        $this->permission();
        $validatedData = $request->validated();
        
        $cin = $validatedData['CIN'];
        $birthDate = str_replace('-', '', $validatedData['birth']);
        $password = $cin . $birthDate;

        $user = Utilisateur::create(array_merge($validatedData, ['password' => $password]));
    
        Mail::to($user->email)->send(new UserVerification(
            $user->id,
            $user->created_at,
            $user->name,
            $user->prenom,
            $user->email
        ));
    
        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function verify_email($hash) {
        [$created_at, $id] = explode('$$', base64_decode((string)$hash));
        $user = Utilisateur::findOrFail($id);
        $user->update(['email_verified_at' => time()]);

        return redirect()->route('validation_email', $user->id);
    }
    
    

    public function validate_email(Utilisateur $user) {
        return view('mail.mail_validation', compact('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Utilisateur $user)
    {
        $this->authorization($user);
        return view('admin.show.user', compact('user'));
    }

    public function password_forget() {
        return view('partiels.password_forget');
    }

    public function password_recap(Request $request) 
    {
        $request->validate(
            [
                'email' =>'required|email|exists:utilisateurs,email',
            ],
            [
                'email.required' => 'Veuillez renseigner votre adresse email',
                'email.email' => 'Veuillez renseigner une adresse email valide',
                'email.exists' => 'L\'adresse mail saisi est invalide.',
            ]
        );
        
        $utilisateur = Utilisateur::where('email', $request->input('email'))->firstOrFail();
        
        $created_at_year = date_format($utilisateur->created_at, 'Y-m-d');
        $created_at = str_replace('-', '', $created_at_year);
        $password = substr($utilisateur->password, 8, 12);
    
        Mail::to($utilisateur->email)->send(new PasswordReacaputilation(
            $utilisateur->id,
            $utilisateur->CIN,
            $password,
            $created_at
        ));
    
        return redirect()->route('login')->with('success', 'Veuillez vérifier votre e-mail afin de réinitialiser votre mot de passe.');
    }

    public function verify_password($hash) {
        [$id, $cin, $password, $created_at] = explode('$$', base64_decode((string)$hash));
        $hashedChain = $id.''.$cin.''.$password.''.$created_at;
        return view('partiels.editPassword', compact('hashedChain', 'id'));
    }
    
    public function confirm_password(Request $request) {
        $request->validate([
            'randomType' => 'required|same:hashedChain',
            'password' => 'required|min:8|max:50',
            'confirm_password' => 'required|same:password',
        ],
        [
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
            'password.max' => 'Le mot de passe ne doit pas dépasser 50 caractères.',
            'password.required' => 'Le mot de passe est requis.',
            'confirm_password.same' => 'Les mots de passe doivent être les mêmes.',
            'randomType.same' => 'La chaîne aléatoire est invalide.',
        ]);

        $utilisateur = Utilisateur::where('id', $request->input('id'))->firstOrFail();
        $utilisateur->update(['password' => $request->input('password')]);

        return redirect()->route('login')->with('success', 'Mot de passe modifié avec succès');
    }

    public function password_landed() 
    {
        return view('partiels.password_reset');
    }

    public function password_reset(Request $request) 
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|max:50',
            'confirm_password' => 'required|same:password',
        ],
        [
            'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
            'password.max' => 'Le mot de passe ne doit pas dépasser 50 caractères.',
            'password.required' => 'Le mot de passe est requis.',
            'confirm_password.same' => 'Les mots de passe doivent correspondre.',
        ]);

        $user = Utilisateur::where('id', auth()->id())->first();
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'L\'ancien mot de passe est incorrect.']);
        }

        $user->update([
            'password' => bcrypt($request->input('password'))
        ]);

        return redirect()->route('login')->with('success', 'Mot de passe modifié avec succès');
    }


        /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utilisateur $user)
    {
        $this->gate($user);
        $services = Service::all();
        return view('admin.edit.user', compact('user', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UtilisateurRequestUp $request, Utilisateur $user)
    {
        $this->gate($user);

        $validatedData = $request->validated(
            [
                'email' => 'required|string|email|unique:utilisateurs,email,'.$user->id,
                'CIN' => 'required|size:7|unique:utilisateurs,CIN,'.$user->id,
                'phone_number' => 'required|string|unique:utilisateurs,phone_number,'.$user->id
            ],
            [
                'email.required' => 'L\'adresse e-mail est requis.',
                'email.unique' => 'L\'adresse e-mail doit être unique.',
                'email.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
                'CIN.required' => 'La CIN est requis.',
                'CIN.unique' => 'La CIN doit être unique.',
                'CIN.min' => 'La CIN doit avoir au moins 6 caractères.',
                'CIN.max' => 'La CIN ne doit pas dépasser 10 caractères.',
                'phone_number.required' => 'Le numéro de téléphone est requis.',
                'phone_number.unique' => 'Le numéro de téléphone doit être unique.',
            ]
        );

        $request->merge(['email' => $user->email]);

        $cin = $request->CIN;
        $birthDate = str_replace('-', '', $request->birth);
        $password = $cin . $birthDate;
        
        $user->update(array_merge($request->all(), ['password' => $password]));
    
        return redirect()->route('users.show', $user->id)->with('success', 'Utilisateur modifié avec succès.');
    }

    /**
     * Show the form for confirming deletion of the specified resource.
     */
    public function delete(Utilisateur $user)
    {
        $this->permission();

        return view('admin.delete.user', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utilisateur $user)
    {
        $this->permission();

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
