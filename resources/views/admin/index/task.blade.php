<x-master title="Tâches accomplies">
    <main class="content px-3 py-4"> 
        <div class="container-fluid">
            <div class="card mb-4 border-0 shadow bg-white">
                <div class="card-header border-0 text-dark bg-white py-1 rounded-0 shadow-sm mb-3">
                    <div class="d-flex justify-content-between my-1">
                        <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            <i class="fas fa-table me-1"></i>
                            Liste des tâches accomplies
                        </a>
                        <a class="btn text-white px-2 py-1 rounded-1"  style="background-color: #B46F55;" href="{{ route('tasks.create') }}">
                            <i class="fas fa-plus-square"></i>
                        </a>
                    </div>    
                </div>
                <form action="{{ route('tasks.index') }}" method="GET" class="px-3 content-form">
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
                            @if ($user->role === 'directeur')
                                <div class="col-md-3 mb-3">
                                    <label for="service" class="form-label ms-1 fw-bold text-secondary">Service :</label>
                                    <select name="service" id="service" class="form-select bg-light rounded-0">
                                        <option value="">Tous les services</option>
                                        @foreach ($services as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
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
                            @endif
                            @if ($user->role === 'fonctionnaire' || $user->role === 'admin')
                                <div class="col-md-3">
                                    <label for="status" class="form-label ms-1 fw-bold text-secondary">Statut :</label>
                                    <select name="status" id="status" class="form-select bg-light rounded-0">
                                        <option value="">Tous les statuts</option>
                                        <option value="en attente">En attente</option>
                                        <option value="validée">Validée</option>
                                        <option value="rejetée">Rejetée</option>
                                    </select>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="filtre d-flex justify-content-end me-2 mt-4">
                        <button type="submit" class="btn border-0 text-secondary btn-transparent fw-bold"><i class="fas fa-filter"></i> Filtrer</button>
                        <a href="{{ route('tasks.index') }}" class="btn border-0  mx-3 btn-transparent text-danger fw-bold"><i class="fas fa-eraser"></i> Clear</a>
                    </div>
                </form>
                <div class="card-body">
                    <div class="card mb-4 border-0 shadow bg-white">
                        <div class="card-header border-0 bg-white shadow-sm p-3 bg-light rounded-0">
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tâche</th>
                                            @if (!($user->role === 'directeur'))
                                            <th>Date de création</th>
                                            @else
                                            <th>Responsable</th>
                                            @endif
                                            @if ($user->role === 'fonctionnaire' || $user->role === 'admin')
                                                <th>Statu</th>
                                            @endif
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $task->name }}</td>
                                            <td>
                                            @if ($user->id === $task->utilisateur_id)
                                                {{ date_format($task->created_at, 'Y-m-d') }}
                                            @else
                                                <a href="{{ route('users.show', $task->utilisateur_id) }}">{{ $task->utilisateur->name }}</a>
                                            @endif
                                            </td>
                                            @if ($user->role === 'fonctionnaire' || $user->role === 'admin')
                                                <td>
                                                    @if ($task->status === 'en attente')
                                                        <button class="btn bg-warning text-black px-2 py-1">En attente</button>
                                                    @elseif ($task->status === 'validée')
                                                        <button class="btn bg-success text-white px-2 py-1">Validée</button>
                                                    @else
                                                        <button class="btn bg-danger text-white px-2 py-1">Rejetée</button>
                                                    @endif
                                                </td>
                                            @endif
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-info px-3 text-black-50" href="{{ route('tasks.show', $task->id) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @unless ($user->role === 'fonctionnaire' && ($task->status === 'validée'))
                                                        <a class="btn btn-primary px-3" href="{{ route('tasks.edit', $task->id) }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a class="btn bg-danger px-3 text-white" href="{{ route('tasks.delete', $task->id) }}">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endunless 
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