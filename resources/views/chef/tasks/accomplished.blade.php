<x-master title="Liste des tâches soumission">
    <main class="content px-3 py-4"> 
        <div class="container-fluid">
            <div class="card mb-4 border-0 shadow bg-white">
                <div class="card-header border-0 text-dark bg-white py-1 rounded-0 shadow-sm mb-3">
                    <div class="d-flex justify-content-between my-1">
                        <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            <i class="fas fa-table me-1"></i>
                            Liste des tâches soumises
                        </a>
                        <section>
                            <a class="btn text-dark px-2 py-1 rounded-1 me-3 btn-light border-0" href="{{ route('tasks.confirmed', ['status' => 'validée']) }}">
                                <i class="fas fa-check-square text-success me-2"></i>Tâches validées
                            </a>
                            <a class="btn text-dark px-2 py-1 rounded-1 btn-light border-0" href="{{ route('tasks.confirmed', ['status' => 'rejetée']) }}">
                            <i class="fas fa-times-square text-danger me-2"></i>Tâches rejetées
                            </a>
                        </section>
                        
                    </div>    
                </div>
                <form action="{{ route('tasks.accomplished') }}" method="GET" class="px-3 content-form">
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
                        </div>
                    </div>
                    <div class="filtre d-flex justify-content-end my-2">
                        <button type="submit" class="border-0 text-secondary bg-transparent fw-bold"><i class="fas fa-filter"></i> Filtrer</button>
                        <a href="{{ route('tasks.accomplished') }}" class="btn mx-3 btn-transparent text-danger fw-bold"><i class="fas fa-eraser"></i> Clear</a>
                    </div>
                </form>
                <div class="card-body">
                    <div class="card mb-4 border-0 shadow bg-white" style="width:90%">
                        <div class="card-header border-0 bg-white shadow-sm p-3 bg-light rounded-0">
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tâche</th>
                                            <th>Responsable</th>
                                            <th>Date de soumission</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $task->name }}</td>
                                                <td>                                        
                                                    <a href="{{ route('users.show', $task->utilisateur_id) }}">{{ $task->utilisateur->name }}</a>
                                                </td>
                                                <td>
                                                @if (date_format($task->created_at, 'Y-m-d') === date('Y-m-d'))
                                                    Aujourd'hui à &nbsp; <span class=" text-primary">{{ date_format($task->created_at, 'H : i : s') }}</span>
                                                @else
                                                    {{ date_format($task->created_at, 'd-m-Y') }}
                                                @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-info px-3 text-black-50" href="{{ route('tasks.show', $task->id) }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a class="btn btn-primary px-3" href="{{ route('tasks.validate', $task->id) }}" onclick='validateTask( event, "{{$task->id}}" )'>
                                                            <i class="fas fa-check"></i>                                
                                                        </a>
                                                        <a class="btn bg-danger px-3 text-white" href="{{ route('tasks.unvalidate', $task->id) }}" onclick='rejectTask(event, "{{ $task->id }}")'>
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

