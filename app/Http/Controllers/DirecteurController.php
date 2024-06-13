<?php

namespace App\Http\Controllers;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_PDF;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Task;
use App\Models\Service;
use App\Models\Difficulty;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class DirecteurController extends Controller
{
    public function index(){
        if(auth()->user() !== null){
            $user = auth()->user();
        }else{
            return redirect()->route("login");
        }
        if($user->role==="directeur"){
            $tasks = Task::with("utilisateur","service")->paginate(10);
            $utilisateurs = Utilisateur::all();
            $services = Service::all();
            $months = $this->filter();
            return view("Directeur.List_des_taches",compact("tasks","utilisateurs","services","months"));
        }else{
            abort(403,'You are not allowed to make this operation');
        }
    }
    public function probleme(){
        $difficultes = Difficulty::with("task")->paginate(10);
        return view("Directeur.difficultes",compact( "difficultes"));
    }
    public function show(Task $task){
        $difficulties = $task->difficulties()->get();
        $diff = [];
        $sol = [];
        foreach ($difficulties as $difficulty) {
            $diff[] = $difficulty->difficulty;
        }
        foreach ($difficulties as $difficulty) {
            $sol[] = $difficulty->solution;
        };
        $difficultiesLength = count($diff);
        $solutionsLength = count($sol);
        return view('Directeur.Détail_de_tache', compact('task', 'diff', 'sol', 'difficultiesLength', 'solutionsLength'));
    }
    public function exportPDF(){
        // $tasks=Task::all();
        // $pdf = PDF::loadView("Directeur.fiche",compact("tasks"));
        // return $pdf->stream();
        $tasks = Task::all();
        $dompdf = new Dompdf();
        $html = view('Directeur.fiche', compact("tasks"))->render();

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf->setOptions($options);

        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->stream('tableau.pdf');
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
