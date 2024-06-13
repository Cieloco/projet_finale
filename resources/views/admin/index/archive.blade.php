<x-master title="Liste d'archives">
    <main class="content px-3 py-4"> 
        <div class="card mb-4 border-0 shadow bg-white">
            <div class="card-header border-0 text-dark bg-white rounded-0 shadow-sm mb-3">
                <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                    <i class="fas fa-table me-1"></i>
                    Liste des tâches archivées
                </a>
            </div>
            <form action="{{ route('tasks.archive') }}" method="GET" class="px-3 content-form">
                <div class="card border-0 px-3">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="year" class="form-label ms-1 fw-bold text-secondary">Année :</label>
                            <select name="year" id="year" class="form-select bg-light rounded-0">
                                <option value="">Toutes les années</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                       
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
                    </div>
                </div>
                <div class="filtre d-flex justify-content-end my-2">
                    <button type="submit" class="border-0 text-secondary bg-transparent fw-bold"><i class="fas fa-filter"></i> Filtrer</button>
                    <a href="{{ route('tasks.archive') }}" class="btn mx-3 btn-transparent text-danger fw-bold"><i class="fas fa-eraser"></i> Clear</a>
                </div>
            </form>
            <div class="card-body">
                <div class="card mb-4 border-0 shadow bg-white" style="width:90%">
                    <div class="card-header border-0 bg-white shadow-sm p-3 bg-light rounded-0">
                        
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Statut</th>
                                            <th>Date de confirmation</th>
                                            <th>Date d'archivage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($archives as $year => $archive)
                                        <tr>
                                            <td>{{ $archive->id }}</td>
                                            <td>{{ $archive->name }}</td>
                                            <td>{{ $archive->type }}</td>
                                            <td>{{ $archive->description }}</td>
                                            <td>{{ $archive->status }}</td>
                                            <td>{{ $archive->confirmed_at }}</td>
                                            <td>{{ $archive->archived_at }}</td>
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
