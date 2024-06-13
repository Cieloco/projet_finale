<style>
    .form-control:focus.x-button {
        border-color: transparent;
        box-shadow: none;
        outline: none;
    }
</style>
    @stack('styles')
@auth        
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>
            <div class="sidebar-logo">
                <a class="text-light">ENCG<span style="color: #B46F55">O</span></a>
            </div>
        </div>
        <ul class="sidebar-nav">
            @if (!(auth()->user()->role === 'directeur'))
            <li class="sidebar-item">
                <a href="{{ route('tasks.create') }}" class="sidebar-link">
                    <i class="lni lni-agenda"></i>
                    <span>Ajouter une tâche</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->role === 'chef')
            <li class="sidebar-item my-2">
                <a class="sidebar-link collapsed" data-bs-toggle="collapse"
                    data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                    <i class="lni lni-layout"></i>
                    <span style="cursor: pointer;">Traçabilité de tâches</span>
                </a>
                <div class="d-flex justify-content-center">
                    <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                        <li class="sidebar-item">
                            <a href="{{ route('tasks.index') }}" class="sidebar-link">Mes réalisations</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('tasks.confirmed') }}" class="sidebar-link">Tâches approuvées</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('tasks.accomplished') }}" class="sidebar-link">Tâches soumises</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            @if (auth()->user()->role === 'fonctionnaire' || auth()->user()->role === 'admin')
            <li class="sidebar-item">
                <a href="{{ route('tasks.index') }}" class="sidebar-link">
                    <i class="fa fa-list"></i>
                    <span>Mes réalisations</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role === "directeur")
            <li class="sidebar-item">
                <a href="{{ route('/list_des_taches') }}" class="sidebar-link">
                    <i class="fa fa-list"></i>
                    <span>Les tâches réalisées</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('/difficulites') }}" class="sidebar-link">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Liste difficultés</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role === "admin")
            <li class="sidebar-item">
                <a href="{{ route('tasks.valide') }}" class="sidebar-link">
                    <i class="fas fa-tasks"></i> <span style="cursor: pointer;">Les tâches validées</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('tasks.archive') }}" class="sidebar-link">
                    <i class="fas fa-archive"></i> <span style="cursor: pointer;">Les tâches archivées</span>
                </a>
            </li>
            <li class="sidebar-item my-2">
                <a class="sidebar-link collapsed" data-bs-toggle="collapse"
                    data-bs-target="#multi-user" aria-expanded="false" aria-controls="multi-user">
                    <i class="lni lni-layout"></i>
                    <span style="cursor: pointer;">Gestion d'utilisateurs</span>
                </a>
                <div class="d-flex justify-content-center">
                    <ul id="multi-user" class="sidebar-dropdown list-unstyled collapse">
                        <li class="sidebar-item">
                            <a href="{{ route('users.index') }}" class="sidebar-link">Liste d'utilisateurs</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('users.create') }}" class="sidebar-link">Ajouter un utilisateur</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-item my-2">
                <a class="sidebar-link collapsed" data-bs-toggle="collapse"
                    data-bs-target="#multi-service" aria-expanded="false" aria-controls="multi-service">
                    <i class="fa fa-building" aria-hidden="true"></i>
                    <span style="cursor: pointer;">Gestion des services</span>
                </a>
                <div class="d-flex justify-content-center">
                    <ul id="multi-service" class="sidebar-dropdown list-unstyled collapse">
                        <li class="sidebar-item">
                            <a href="{{ route('services.index') }}" class="sidebar-link">Liste des services</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('services.create') }}" class="sidebar-link">Ajouter un service</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
        </ul>
        <div class="sidebar-footer">
            <div class="sidebar-item">
                <a href="{{ route('users.show', auth()->id()) }}" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Profil</span>
                </a>
            </div>
            <a href="{{ route('logout') }}" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Déconnexion</span>
            </a>
        </div>
    </aside>
    <div class="main">
    @include('components.alert')

        <nav class="navbar navbar-expand px-4 py-3 bg-white shadow-sm">
            <div class="navbar-collapse collapse">
                <form class="d-flex">
                    <input class="form-control rounded-end-0 x-button" type="search" placeholder="Rechercher" aria-label="Search">
                    <button class="btn btn-dark rounded-start-0" type="submit"><i class="fas fa-search"></i></button>
                </form>
                        
                <ul class="navbar-nav ms-auto align-items-center">
                    
                    <li class="nav-item dropdown">
                        <a data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                            <i class="fas fa-user text-dark" style="font-size: 1.8em; cursor:pointer;"></i>
                        </a>
                        <ul class="dropdown-menu text-center dropdown-menu-end rounded border-0 shadow px-2" aria-labelledby="profile-dropdown">
                            <li>
                                <div class="rounded-3 bg-light mb-3 py-2">
                                <i class="fas fa-user" style="color: #654321; font-size: 1.6em;"></i>
                                </div>
                                <h6>{{ auth()->user()->name }}</h6>
                                <p>{{ auth()->user()->email }}</p>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('users.show', auth()->id()) }}">Profil</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">Déconnexion</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    @endauth