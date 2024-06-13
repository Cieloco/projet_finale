<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\Service;
use App\Models\Task;
use App\Models\Utilisateur;

class ArchiveController extends Controller
{

    private function permission() {
        if(auth()->check()) {
            $user = auth()->user();
            if (!($user->role === 'admin')) {
                abort(403);
            }
        }
    }
    public function archived(Request $request) {
        $this->permission();
    
        // Récupérer tous les services
        $services = Service::pluck('name', 'id');
    
        // Récupérer tous les employés
        $employees = Utilisateur::whereNot('role', 'directeur')->pluck('name', 'id');
    
        // Récupérer les années d'archivage
        $years = Archive::selectRaw('YEAR(archived_at) as year')
                        ->distinct()
                        ->pluck('year', 'year');
    
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
    
        // Requête de récupération des archives
        $archives = Archive::query();
    
        // Filtrer par année
        if ($request->filled('year')) {
            $archives->whereYear('archived_at', $request->year);
        }
    
        // Filtrer par mois
        if ($request->filled('month')) {
            $archives->whereMonth('archived_at', $request->month);
        }
    
        // Filtrer par service
        if ($request->filled('service')) {
            $archives->where('service_id', $request->service);
            $employees = Utilisateur::whereNot('role', 'directeur')->where('service_id', $request->service)->pluck('name', 'id');
        }
    
        // Filtrer par fonctionnaire
        if ($request->filled('employee')) {
            $archives->where('utilisateur_id', $request->employee);
        }
    
        // Récupérer les archives selon les filtres
        $archives = $archives->orderBy('archived_at', 'desc')->get();
    
        // Retourner la vue avec les données 
        return view('admin.index.archive', compact('archives', 'services', 'employees', 'months', 'years'));
    }
    

    public function validated(Request $request) {
        $this->permission();

        // Récupérer tous les services
        $services = Service::pluck('name', 'id');
    
        // Récupérer tous les employés
        $employees = Utilisateur::whereNot('role', 'directeur')->pluck('name', 'id');
    
    
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
    
        // Requête de récupération des archives
        $tasks = Task::query();

    
        // Filtrer par mois
        if ($request->filled('month')) {
            $tasks->whereMonth('confirmed_at', $request->month);
        }
    
        // Filtrer par service
        if ($request->filled('service')) {
            $tasks->where('service_id', $request->service);
            $employees = Utilisateur::whereNot('role', 'directeur')->where('service_id', $request->service)->pluck('name', 'id');
        }
    
        // Filtrer par fonctionnaire
        if ($request->filled('employee')) {
            $tasks->where('utilisateur_id', $request->employee);
        }
    
        // Récupérer les ta$tasks selon les filtres
        $tasks = $tasks->where('status', 'validée')->orderBy('created_at', 'desc')->get();

        return view('admin.index.valide', compact('tasks', 'months', 'services', 'employees'));
    }
}
