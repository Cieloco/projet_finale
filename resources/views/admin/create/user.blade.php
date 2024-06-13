<x-master title="Ajout d'utilisateurs">
    <main class="content px-3 py-4" style="width: 90%;">
        <div class="card mb-4 border-0 shadow bg-white">
            <div class="card-header border-0 text-dark bg-white rounded-0 shadow-sm mb-3">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                        <i class="fas fa-plus-circle me-1"></i>
                        Ajout d'utilisateurs
                    </a>
                    <a class="btn text-white me-2 px-2 py-1 rounded-1"  style="background-color: #B46F55;" href="{{ route('users.index') }}">
                        <i class="fas fa-times-circle"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-1 mt-3">
                                    <label>CIN</label>
                                    <input type="text" name="CIN"  style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('CIN') }}" placeholder="Saisir le CIN" />
                                </div>
                                @error('CIN')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1 mt-3">
                                    <label>Date de naissance</label>
                                    <input type="date" id="birth" name="birth" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('birth') }}" placeholder="Choisir la date de naissance">
                                </div>
                                @error('birth')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-1 mt-3">
                                    <label>Prénom</label>
                                    <input type="text" name="prenom"  style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('prenom') }}" placeholder="Saisir le prénom d'utilisateur" />
                                </div>
                                @error('prenom')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1 mt-3">
                                    <label>Nom</label>
                                    <input type="text" name="name" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('name') }}" placeholder="Saisir le nom d'utilisateur" />
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-1 mt-3">
                                    <label>Numéro de téléphone</label>
                                    <input type="tel" name="phone_number" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('phone_number') }}" placeholder="Saisir le numéro de téléphone">
                                </div>
                                @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="my-2 mt-3">
                                    <label>Adresse mail</label>
                                    <input type="text" name="email" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('email') }}" placeholder="Saisir l'email">
                                </div>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-1 mt-3">
                                    <label for="role">Rôle</label>
                                    <select id="role" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="role">
                                        <option value="" {{ old('role') == '' ? 'selected' : '' }}></option>
                                        @foreach(['fonctionnaire' => 'Fonctionnaire', 'chef' => 'Chef de service', 'directeur' => 'Directeur', 'admin' => 'Administrateur'] as $value => $label)
                                            <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-1 mt-3">
                                    <label>Service</label>
                                    <select style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="service_id">
                                        <option value="" {{ old('service_id') == '' ? 'selected' : '' }}></option>
                                        @foreach ($services as $service)
                                            <option value="{{$service->id}}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('service_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-1 mt-4" style="width:95%;">
                            <button type="submit" class="btn btn-primary me-4">
                                <i class="fas fa-plus-square me-2"></i> Ajouter
                            </button>
                            <button type="reset" class="btn btn-light">
                                <i class="fas fa-undo me-2"></i> Réinitialiser les champs
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <script src="https://cdn.tiny.cloud/1/jf78x7mks1v1i55zep8xfnov2866mle5i7qfp20fntec88c4/tinymce/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#body_event'
        });
    </script>
</x-master>
