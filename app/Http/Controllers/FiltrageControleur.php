<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Service;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class filtrageControleur extends Controller
{
    public function filterFonctionnaire(Request $request){
        $months = $this->filter();
        $utilisateurs = Utilisateur::all();
        $services = Service::all();
        $tasks = Task::where("utilisateur_id",$request->idFonctionnaire)->paginate(10);
        return view("Directeur.List_des_taches",compact("utilisateurs","services","tasks","months"));
    }
    public function filterService(Request $request){
        $months = $this->filter();
        $utilisateurs = Utilisateur::all();
        $services = Service::all();
        $tasks = Task::where("service_id",$request->idService)->paginate(10);
        return view("Directeur.List_des_taches",compact("utilisateurs","services","tasks","months"));
    }
    public function filterDate(Request $request){
        $months = $this->filter();
        $utilisateurs = Utilisateur::all();
        $services = Service::all();
        $year = date("Y-".$request->idDate);
        $tasks = Task::where("created_at","like","%$year%")->paginate(10);
        return view("Directeur.List_des_taches",compact("utilisateurs","services","tasks", "months"));
    }
    private function filter(){
        return[
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
    }
}
