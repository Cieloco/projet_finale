<x-master title="Création d'un Service">
    <main class="content px-3 py-4 w-75 mx-auto">
        <div class="container-fluid">
            <div class="card mb-4 border-0 shadow bg-white">
                <div class="card-header border-0 text-dark bg-white rounded-0 shadow-sm mb-3">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            <i class="fas fa-plus-circle me-1"></i>
                            Création d'un Service
                        </a>
                        <a class="btn text-white me-2 px-2 py-1 rounded-1"  style="background-color: #B46F55;" href="{{ route('services.index') }}">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf
                        <div style="width: 90%;">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du Service</label>
                                <input type="text" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" id="name" name="name" value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-info text-black-50 mt-4">
                                    <i class="fas fa-plus-square fs-5"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-master>
