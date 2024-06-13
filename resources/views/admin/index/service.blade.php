<x-master title="Liste des Services">
    <main class="content px-3 py-4">
        <div class="container-fluid">
            <div class="card mb-4 border-0 shadow bg-white">
                <div class="card-header border-0 text-dark bg-white py-1 rounded-0 shadow-sm mb-3">
                    <div class="d-flex justify-content-between my-1">
                        <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            <i class="fas fa-table me-1"></i>
                            Liste des services
                        </a>
                        <a class="btn text-white px-2 py-1 rounded-1"  style="background-color: #B46F55;" href="{{ route('services.create') }}">
                            <i class="fas fa-plus-square"></i>
                        </a>
                    </div>    
                </div>
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
                                            <th>Nom du Service</th>                 
                                            <th>Chef du Service</th>
                                            <th>Effectif du Service</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                    @foreach ($services as $service)
                                        @if (count($service->utilisateurs) >= 1)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $service->name }}</td>
                                                <td>
                                                @foreach ($service->utilisateurs as $utilisateur)
                                                    <a href="{{ route('users.show', $utilisateur->id) }}">{{ $utilisateur->role === 'chef' ? $utilisateur->name : ''}}</a>
                                                @endforeach
                                                </td>
                                                <td>{{ count($service->utilisateurs) }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-info px-3 text-black-50" href="{{ route('services.show', $service->id) }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a class="btn btn-primary px-3" href="{{ route('services.edit', $service->id) }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a class="btn bg-danger px-3 text-white" href="{{ route('services.delete', $service->id) }}">
                                                            <i class="fas fa-trash"></i>
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
                </div>
            </div>
        </div>
    </main>
</x-master>
