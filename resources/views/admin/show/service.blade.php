<x-master title="Détails du Service {{ $service->name }}">
    <main class="content px-3 py-4 w-75 mx-auto">
        <div class="container">
            <div class="card mb-4 border-0 shadow">
                <div class="card-header border-0 text-dark bg-white rounded-0 shadow-sm mb-3">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            <h6 class="m-0"><i class="fas fa-building me-2"></i>Détails du Service {{ $service->name }}</h6>
                        </a>
                        @if ((auth()->user()->role === 'admin'))
                            <a class="btn text-white me-2 px-2 py-1 rounded-1"  style="background-color: #B46F55;" href="{{ route('services.index') }}">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        @else
                            <a class="btn text-white me-2 px-2 py-1 rounded-1"  style="background-color: #B46F55;" href="{{ route('users.show', auth()->id()) }}">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        @endif
                    </div>
                </div>                
                <div class="card-body d-flex justify-content-center mt-4">
                    <div class="card mb-4 border-0 shadow me-4 w-50">
                        <div class="card-header border-0 text-dark py-2 bg-light rounded-0">
                            <h6 class="m-0"><i class="fas fa-user-tie me-2"></i>Chef du Service</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <p>
                                    @if ($chef)
                                        <a href="{{ route('users.show', $chef->id) }}" class="text-decoration-none">{{ $chef->name }}</a>
                                    @else
                                        Aucun chef assigné
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 border-0 shadow w-50">
                        <div class="card-header border-0 text-dark py-2 bg-light rounded-0">
                            <h6 class="m-0"><i class="fas fa-users me-2"></i>Fonctionnaires Subordonnés</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <ul class="list-unstyled">
                                    @forelse ($fonctionnaires as $fonctionnaire)
                                        <li><a href="{{ route('users.show', $fonctionnaire->id) }}" class="text-decoration-none">{{ $fonctionnaire->name }}</a></li>
                                    @empty
                                        <li>Aucun fonctionnaire subordonné</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-master>
