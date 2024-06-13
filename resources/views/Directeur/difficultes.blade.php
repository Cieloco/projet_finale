<x-master title="list des taches ">
    <main class="content px-3 py-4">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <div class="container-fluid">
            <div class="card mb-4 border-0 shadow bg-white">
                <div class="card-header border-0 text-white py-1" style="background-color: #B46F55; border-radius: 0;">
                    <i class="fas fa-table me-1"></i>
                    Liste des tâches Réalisées
                </div>
                <div class="card-body">
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID Difficulté</th>
                                    <th>Description de Difficulté</th>
                                    <th>La Tâche lieé</th>
                                    <th>La Date de Création</th>
                                    <th>La Solution de  la Difficulté</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($difficultes as $difficulte)
                                    <tr>
                                        <td>{{$difficulte->id}}</td>
                                        <td>{{$difficulte->difficulty}}</td>
                                        <td>{{$difficulte->task->name}}</td>
                                        <td>{{$difficulte->created_at->format("Y-m-d")}}</td>
                                        <td>{{$difficulte->solution}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$difficultes->links()}}
                </div>
            </div>
        </div>
    </main>
</x-master>
