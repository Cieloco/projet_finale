<x-master title="Vue de la tâche {{ $task->name }}">
    <main class="container py-4 px-3">
        <div class="row">
            <div class="card mb-4 border-0 shadow bg-white p-0">
                <div class="card-header border-0 text-dark bg-white rounded-0 shadow-sm mb-3">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            <i class="fas fa-eye me-1"></i>
                            Vue de la tâche {{ $task->name }}
                        </a>
                        <a class="btn text-white me-2 px-2 py-1 rounded-1"  style="background-color: #B46F55;" href="{{ route('tasks.index') }}">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="taskname">Tâche {{ $task->type }} </label>
                                <input type="text" id="taskname" style="width: 96%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ $task->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="responsible">Responsable </label>
                                <a href="{{ route('users.show', $task->utilisateur->id) }}">
                                    <input type="text" id="responsible" style="width: 96%;cursor:pointer;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" style="cursor: pointer;" value="{{ $task->utilisateur->name.' '.$task->utilisateur->prenom }}" readonly>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-4">
                            <div class="form-group">
                                @if ($task->confirmed_at !== NULL)
                                    <label for="confimed">{{ $task->status === 'validée' ? 'Validée en' : 'Rejetée en'}} </label>
                                    <input type="text" id="confimed" style="width: 96%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ $task->confirmed_at }}" readonly>
                                @else
                                    <label for="unconfirmed">Statut</label>
                                    <input type="text" id="unconfirmed" style="width: 96%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ $task->status }}" readonly>
                                @endif
                                
                            </div>
                        </div>
                        <div class="col-md-6 my-4">
                            <div class="form-group">
                                <label for="created">Date de création</label>
                                <input type="text" id="created" style="width: 96%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ $task->created_at->format('d/m/Y') }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" style="width: 98%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" readonly>{{ $task->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                    @if ($task->resources()->where('type', 'humain')->count() > 0)
                        <div class="card my-4 border-0 shadow me-5 rounded-0 p-0" style="width:46%;">
                            <div class="card-header border-0 text-dark py-2 rounded-0 bg-light">
                                <h6 class="m-0 text-primary"><i class="fas fa-user-tie me-2"></i>Ressources humains</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    @foreach ($task->resources as $index => $resource)
                                        @if ($resource->type === 'humain')
                                            <p class="ms-3"> {{ $resource->name }}</p>   
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($task->resources()->where('type', 'materiel')->count() > 0)
                        <div class="card my-4 border-0 shadow me-4 rounded-0 p-0" style="width:46%;">
                            <div class="card-header border-0 text-dark py-2 rounded-0 bg-light">
                                <h6 class="m-0 text-primary"><i class="fas fa-tools me-2"></i>Ressources matériels</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    @foreach ($task->resources as $index => $resource)
                                        @if ($resource->type === 'materiel')
                                            <p class="ms-3"> {{ $resource->name }}</p>     
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($difficultiesLength > 0)
                        <div class="card my-4 border-0 shadow me-5 rounded-0 p-0" style="width:46%;">
                            <div class="card-header border-0 text-dark py-2 rounded-0 bg-light">
                                <h6 class="m-0"><i class="fas fa-exclamation-triangle text-danger me-2"></i> Difficultés rencontrées</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    @foreach ($diff as $index => $difficulty)
                                        <p class="ms-3"><span class="text-danger">Difficulté {{ $index + 1 }} : </span>&nbsp; {{ $difficulty }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($solutionsLength > 0)
                        @php
                            $hasNonNullSolutions = false;
                            foreach ($sol as $s) {
                                if ($s !== null) {
                                    $hasNonNullSolutions = true;
                                    break;
                                }
                            }
                        @endphp
                        @if ($hasNonNullSolutions)
                            <div class="card my-4 border-0 shadow me-4 rounded-0 p-0" style="width:46%;">
                                <div class="card-header border-0 text-dark py-2 rounded-0 bg-light">
                                    <h6 class="m-0"><i class="fas fa-shield-alt text-info me-2"></i>Solutions proposées</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        @foreach ($sol as $index => $solution)
                                                <p class="ms-3"><span class="text-info">Solution {{ $index + 1 }} : </span>&nbsp; {{ $solution }}</p>     
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    </div>
                    @if (!(auth()->user()->role === 'admin') && !(auth()->id() === $task->utilisateur_id) || (auth()->user()->role === 'fonctionnaire' && ($task->status === 'validée')))
                        <div></div>
                    @else
                        <div class="d-flex justify-content-end me-4">
                            <a href="{{ route('tasks.edit', $task->id) }}" style="background-color: lightgray;" class="btn px-3">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    @endif
                    @if (auth()->user()->role === 'chef' && auth()->id() !== $task->utilisateur_id)
                        @if ($task->status === 'rejetée')
                            <a class="btn btn-primary px-3 me-3" href="{{ route('tasks.validate', $task->id) }}" onclick='validateTask( event, "{{$task->id}}" )'>
                                <i class="fas fa-check me-2"></i>Validée                                
                            </a>
                        @else
                            <a class="btn bg-danger px-3 text-white" href="{{ route('tasks.unvalidate', $task->id) }}" onclick='rejectTask(event, "{{ $task->id }}")'>
                                <i class="fas fa-times me-2"></i>Rejetée
                            </a>
                        @endif
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
