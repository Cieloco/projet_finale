<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Task;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChefController extends Controller
{
 
    private function permission($user) {
        if(auth()->check()) {
            if (!($user->role === 'chef')) {
                abort(403, 'You are not allowed to make this operation');
            }
        }
    }

    public function confirmed(Request $request) {
        $user = auth()->user();
        $this->permission($user);
    
        // Récupérer tous les employés
        $employees = Utilisateur::where('service_id', $user->service_id)->where('id', '!=', $user->id)->pluck('name', 'id');
    
        // Récupérer les mois
        $months = [
            '01' => 'Janvier',
            '02' => 'Février',
            '03' => 'Mars',
            '04' => 'Avril',
            '05' => 'Mai',
            '06' => 'Juin',
            '07' => 'Juillet',
            '08' => 'Août',
            '09' => 'Septembre',
            '10' => 'Octobre',
            '11' => 'Novembre',
            '12' => 'Décembre',
        ];
    
        // Requête de récupération des tâches validées et rejetées
        $tasksValid = Task::where('status', 'validée')->whereNotNull('confirmed_at');
        $tasksUnValid = Task::where('status', 'rejetée')->whereNotNull('confirmed_at');
    
        // Filtrer par mois
        if ($request->filled('month')) {
            $tasksValid->whereMonth('confirmed_at', $request->month);
            $tasksUnValid->whereMonth('confirmed_at', $request->month);
        }
    
        // Filtrer par fonctionnaire
        if ($request->filled('employee')) {
            $tasksValid->where('utilisateur_id', $request->employee);
            $tasksUnValid->where('utilisateur_id', $request->employee);
        }
    
        // Filtrer par statut
        if ($request->filled('status')) {
            $status = $request->status;
            $tasksValid->where('status', $status);
            $tasksUnValid->where('status', $status);
        }
    
        // Récupérer les tâches selon les filtres
        $tasksValid = $tasksValid->where('service_id', $user->service_id)->orderBy('created_at', 'desc')->get();
        $tasksUnValid = $tasksUnValid->where('service_id', $user->service_id)->orderBy('created_at', 'desc')->get();
    
        return view('chef.tasks.confirmed', compact('tasksValid', 'tasksUnValid', 'months', 'employees'));
    }
    
    

    public function valid(Task $task) {
        $user = auth()->user();
        $this->permission($user);
        $task->update([
            'confirmed_at' => now(),
            'status' => 'validée'
        ]);
        return redirect()->back()->with('success', 'La tâche a été validée avec succès.');
    }
    

    public function unvalid(Task $task) {
        $user = auth()->user();
        $this->permission($user);
        $task->update([
            'confirmed_at' => now(),
            'status' => 'rejetée'
        ]);
        return redirect()->back()->with('success', 'La tâche a été rejetée avec succès.');
    }

    public function uncomfirmed(Request $request)
    {
        $user = auth()->user();
        $this->permission($user);

        // Récupérer tous les employés
        $employees = Utilisateur::where('service_id', $user->service_id)->where('id', '!=', $user->id)->pluck('name', 'id');
    
        // Récupérer les mois
        $months = [
            '01' => 'Janvier',
            '02' => 'Février',
            '03' => 'Mars',
            '04' => 'Avril',
            '05' => 'Mai',
            '06' => 'Juin',
            '07' => 'Juillet',
            '08' => 'Août',
            '09' => 'Septembre',
            '10' => 'Octobre',
            '11' => 'Novembre',
            '12' => 'Décembre',
        ];

        $tasks = Task::query();
    
        // Filtrer par mois
        if ($request->filled('month')) {
            $tasks->whereMonth('confirmed_at', $request->month);
        }
    
        // Filtrer par fonctionnaire
        if ($request->filled('employee')) {
            $tasks->where('utilisateur_id', $request->employee);
        }

        $tasks = $tasks->where('status', 'en attente')->where('service_id', $user->service_id)->orderBy('created_at', 'desc')->get();
        
        return view('chef.tasks.accomplished', compact('tasks', 'months', 'employees'));
    }

}
