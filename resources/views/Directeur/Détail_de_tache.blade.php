<x-master title="Le détail de tache">
    <main class="content px-3 py-4">
        <div class="container">
            <div class="card mb-4 border-0 shadow bg-white">
                <div class="card-header border-0 text-white py-1" style="background-color: #B46F55; border-radius: 0;">
                    <i class="fas fa-tasks me-1"></i> Détail de tache
                </div>
                <div class="d-flex justify-content-end">
                    <a class="btn text-white me-2 mt-1 px-2 py-1 rounded-1"  style="background-color: #B46F55;" href="{{ route('/list_des_taches') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="card-body bg-light p-4 rounded" id="taskCardBody">
                        <!-- Le contenu de votre section card-body -->
                        <div class="d-flex justify-content-center mb-3">
                            <h1 class="card-title text-primary">Titre de Tâche:</h1>
                            <h1 class="card-text text-muted ml-2">{{$task->name}}</h1>
                        </div>
                        <div class="mb-3">
                            <h4 class="text-primary">Description:</h4>
                            <p class="card-text text-muted">{{$task->description}}</p>
                        </div>
                        <div class="mb-3">
                            <h4 class="text-primary">Type:</h4>
                            <p class="card-text text-muted">{{$task->type}}</p>
                        </div>
                        <div class="mb-3">
                            <h4 class="text-primary">Service:</h4>
                            <p class="card-text text-muted">{{$task->service->name}}</p>
                        </div>
                        <div class="mb-3">
                            <h4 class="text-primary">Date de création:</h4>
                            <p class="card-text text-muted">{{$task->created_at}}</p>
                        </div>
                        <div class="mb-3">
                            <h4 class="text-primary">Date de confirmation:</h4>
                            <p class="card-text text-muted">{{$task->confirmed_at}}</p>
                        </div>
                        <div class="mb-3">
                            <h4 class="text-primary">Le nom de Réalisateur:</h4>
                            <p>{{$task->utilisateur->name}}</p>
                        </div>
                        <div>
                            <h4 class="text-primary">Le rôle:</h4>
                            <p class="card-text text-muted">{{$task->utilisateur->role}}</p>
                        </div>
                        @if ($difficultiesLength > 0 && $solutionsLength > 0)
                            <div>
                                <h4 class="text-primary">La difficulté recontré:</h4>
                                @foreach ($diff as $difficulty)
                                    <p class="card-text text-muted">{{ $difficulty }}</p>
                                @endforeach
                            </div>
                            <div>
                                <h4 class="text-primary">La solution proposé:</h4>
                                @foreach ($sol as $solution)
                                    <p class="card-text text-muted">{{ $solution }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                </div>
                
                <div class="d-flex justify-content-center card-footer text-muted">
                    <button class="btn btn-success" id="printButton">Imprimer</button>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('printButton').addEventListener('click', function() {
    // Récupérer la section `card-body`
    var cardBody = document.getElementById('taskCardBody').innerHTML;

    // Créer une nouvelle fenêtre
    var printWindow = window.open('', '_blank');

    // Injecter le contenu de `card-body` dans la nouvelle fenêtre
    printWindow.document.open();
    printWindow.document.write(`
        <html>
        <head>
            <title>Impression</title>
            <!-- Inclure les styles nécessaires -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container">
                <div class="card-body bg-light p-4 rounded">
                    ${cardBody}
                </div>
            </div>
        </body>
        </html>
    `);
    printWindow.document.close();

    // Lancer l'impression
    printWindow.print();

    // Fermer la fenêtre après l'impression
    printWindow.onafterprint = function() {
        printWindow.close();
    };
});

        </script>
    </main>
</x-master>
