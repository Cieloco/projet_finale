<x-master title="Modification de l'utilisateur {{ $user->name }}">
    <main class="content px-3 py-4" style="width: 90%;">
        <div class="card mb-4 border-0 shadow bg-white">
            <div class="card-header border-0 text-dark bg-white rounded-0 shadow-sm mb-3">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                        <i class="fas fa-edit me-1"></i>
                        Modification du l'utilisateur {{ $user->name.' '.$user->prenom }}
                    </a>
                    <a class="btn text-white me-2 px-2 py-1 rounded-1"  style="background-color: #B46F55;" href="{{ route('users.index') }}">
                        <i class="fas fa-times-circle"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT') 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label>CIN</label>
                                    <input type="text" name="CIN"  style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('CIN', $user->CIN) }}" placeholder="Saisir le CIN" />
                                </div>
                                @error('CIN')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label>Date de naissance</label>
                                    <input type="date" id="birth" name="birth" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('birth', $user->birth) }}" placeholder="Choisir la date de naissance">
                                </div>
                                @error('birth')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label>Prénom</label>
                                    <input type="text" name="prenom"  style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('prenom', $user->prenom) }}" placeholder="Saisir le prénom d'utilisateur" />
                                </div>
                                @error('prenom')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label>Nom</label>
                                    <input type="text" name="name" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('name', $user->name) }}" placeholder="Saisir le nom d'utilisateur" />
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label>Numéro de téléphone</label>
                                    <input type="tel" name="phone_number" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Saisir le numéro de téléphone">
                                </div>
                                @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label>Adresse mail</label>
                                    <input type="text" name="email" style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ old('email', $user->email) }}" placeholder="Saisir l'email">
                                </div>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group my-3">
                                    <label>Rôle</label>
                                    <select style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="role">
                                        <option value="" selected></option>
                                        @foreach(['fonctionnaire' => 'Fonctionnaire', 'chef' => 'Chef de service', 'directeur' => 'Directeur', 'admin' => 'Administrateur'] as $value => $label)
                                            <option value="{{ $value }}" @if(old('role', $user->role) == $value) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-3">
                                    <label>Service</label>
                                    <select style="width: 90%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" name="service_id">
                                        <option value="" selected></option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" @if(old('service_id', $user->service_id) == $service->id) selected @endif>{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('service_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between my-3" style="width:95%;">
                            <button type="submit" class="btn btn-primary me-4">
                                <i class="fas fa-edit me-2"></i> Enregistrer
                            </button>
                            <a href="{{ route('password.land') }}" class="btn btn-light">
                                <i class="fas fa-key me-2"></i> Réinitialiser le mot de passe
                            </a>
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
