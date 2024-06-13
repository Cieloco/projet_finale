<x-master title="Liste des tâches vérifiées">
    <main class="content px-3 py-4"> 
        <div class="container-fluid">
            <div class="card mb-4 border-0 shadow bg-white">
                <div class="card-header border-0 text-dark bg-white py-1 rounded-0 shadow-sm mb-3">
                    <div class="d-flex justify-content-between my-1">
                        <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            <i class="fas fa-table me-1"></i>
                            Liste des tâches vérifiées
                        </a>
                    </div>    
                </div>
                <form action="{{ route('tasks.confirmed') }}" method="GET" class="px-3 content-form">
                    <div class="card border-0 px-3">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="month" class="form-label ms-1 fw-bold text-secondary">Mois :</label>
                                <select name="month" id="month" class="form-select bg-light rounded-0">
                                    <option value="">Toutes les mois</option>
                                    @foreach ($months as $key => $month)
                                        <option value="{{ $key }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3 me-5">
                                <label for="employee" class="form-label ms-1 ms-1 fw-bold text-secondary">Fonctionnaire :</label>
                                <select name="employee" id="employee" class="form-select bg-light rounded-0">
                                    <option value="">Tous les fonctionnaires</option>
                                    @foreach ($employees as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="status" class="form-label ms-1 fw-bold text-secondary">Statut :</label>
                                <select name="status" id="status" class="form-select bg-light rounded-0">
                                    <option value="">Tous les statuts</option>
                                    <option value="validée">Validée</option>
                                    <option value="rejetée">Rejetée</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="filtre d-flex justify-content-end my-2">
                        <button type="submit" class="border-0 text-secondary bg-transparent fw-bold"><i class="fas fa-filter"></i> Filtrer</button>
                        <a href="{{ route('tasks.confirmed') }}" class="btn mx-3 btn-transparent text-danger fw-bold"><i class="fas fa-eraser"></i> Clear</a>
                    </div>
                </form>
                <div class="card-body">
                    @if(count($tasksValid) > 0)
                    <div class="card mb-4 border-0 shadow bg-white" style="width:92%">
                        <div class="card-header border-0 text-white py-1 bg-light rounded-0">
                            <h6 class="text-dark"><i class="fas fa-check-circle me-3 fw-bolder"></i> Liste des tâches validées</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tâches &nbsp; Validées</th>
                                            <th>Responsable</th>
                                            <th>Date de soumission</th>
                                            <th>Date de validation</th>
                                            <th>Vue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($tasksValid as $index => $task)
                                            @if (!($task->utilisateur->role === 'chef'))
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $task->name }}</td>
                                                <td>                                        
                                                    <a href="{{ route('users.show', $task->utilisateur_id) }}">{{ $task->utilisateur->name }}</a>
                                                </td>
                                                <td>
                                                @if (date_format($task->created_at, 'Y-m-d') === date('Y-m-d'))
                                                    Aujourd'hui à <br/> <span class=" text-primary">{{ date_format($task->created_at, 'H : i : s') }}</span>
                                                @else
                                                    {{ date_format($task->created_at, 'd-m-Y') }}
                                                @endif
                                                </td>
                                                <td>{{ $task->confirmed_at }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn px-3 btn-info text-black-50" href="{{ route('tasks.show', $task->id) }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a class="btn px-3 text-black-50" style="background-color:lightcoral" href="{{ route('tasks.unvalidate', $task->id) }}" onclick='rejectTask(event, "{{ $task->id }}")'>
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(count($tasksUnValid) > 0)
                    <div class="card my-5 border-0 shadow bg-white" style="width:92%">
                        <div class="card-header border-0 text-white py-1 bg-light rounded-0">
                            <h6 class="text-dark"><i class="fas fa-times-circle me-3 fw-bolder"></i> Liste des tâches rejetées</h6>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tâches &nbsp; Rejetées</th>
                                        <th>Responsable</th>
                                        <th>Date de soumission</th>
                                        <th>Date de réjection</th>
                                        <th>Vue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($tasksUnValid as $index => $task)
                                        @if (!($task->utilisateur->role === 'chef'))
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $task->name }}</td>
                                            <td>                                        
                                                <a class="text-danger border-danger-bottom" href="{{ route('users.show', $task->utilisateur_id) }}">{{ $task->utilisateur->name }}</a>
                                            </td>
                                            <td>
                                            @if (date_format($task->created_at, 'Y-m-d') === date('Y-m-d'))
                                                Aujourd'hui à <br/> <span class=" text-danger">{{ date_format($task->created_at, 'H : i : s') }}</span>
                                            @else
                                                {{ date_format($task->created_at, 'd-m-Y') }}
                                            @endif
                                            </td>
                                            <td>{{ $task->confirmed_at }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn px-3 text-black-50" style="background-color:lightcoral" href="{{ route('tasks.show', $task->id) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn text-black-50 btn-info px-3" href="{{ route('tasks.validate', $task->id) }}" onclick='validateTask( event, "{{$task->id}}" )'>
                                                        <i class="fas fa-check"></i>                                
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach         
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div> 
    </main>
</x-master>   

<script>
    function validateTask(event, taskId) {
        event.preventDefault();
        Swal.fire({
            title: 'Êtes-vous sûr de vouloir valider cette tâche ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Valider'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/tasks/validate" + "/" + taskId;
            }
        });
    }

    function rejectTask(event, taskId) {
        event.preventDefault();
        Swal.fire({
            title: 'Êtes-vous sûr de vouloir rejeter cette tâche ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Rejeter'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/tasks/unvalidate" + "/" + taskId;
            }
        });
    }
</script>
