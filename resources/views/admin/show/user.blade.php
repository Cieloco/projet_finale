<x-master title="Profil de l'utilisateur {{ $user->name }}">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4 border-0 shadow bg-white">
                    <div class="card-header border-0 text-dark bg-white rounded-0 shadow-sm mb-3">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tasks.index') }}" class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                                <i class="fas fa-binoculars me-1"></i>
                                {{auth()->id() !== $user->id ? 'Profil de '. $user->name : 'Mon Profil'}}
                            </a>
                            @if (auth()->user()->role === 'admin')
                                <a class="btn text-white me-2 px-2 py-1 rounded-1"  style="background-color: #B46F55;" href="{{ route('users.index') }}">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Nom d'utilisateur</label>
                                    <input type="text" id="username" style="width: 96%;cursor:pointer;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ $user->name.' '.$user->prenom }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="CIN">Carte d'Identité Nationale </label>
                                    <input type="text" id="CIN" style="width: 96%;cursor:pointer;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ $user->CIN }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" id="email" style="width: 96%;cursor:pointer;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ $user->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label for="tele">Numéro de téléphone </label>
                                    <input type="text" id="tele" style="width: 96%;cursor:pointer;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ $user->phone_number }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label for="role">Rôle</label>
                                    <input type="text" id="role" style="width: 96%;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ $user->role }}" readonly>
                                </div>
                            </div>
                            @if (!(auth()->user()->role === 'directeur'))
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label for="service">Service</label>
                                    <a href="{{ route('services.show', $user->service_id) }}">
                                        <input type="text" id="service" style="width: 96%;cursor:pointer;" class="form-control bg-light rounded-0 border-0 border-bottom mt-1" value="{{ $user->service->name }}" readonly>
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                        @if (auth()->user()->role === 'admin' || (auth()->user()->id === $user->id ))
                            <div class="mt-4 d-flex justify-content-end me-3">
                                <a href="{{ route('users.edit', $user->id) }}" style="background-color: lightgray;" class="btn px-3">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>
