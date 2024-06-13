<x-master title="Réinitialisation de mot de passe">
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        @media (max-width: 450px) {
            .h-custom {
            height: 100%;
            }
        }
    </style>
</head>
<body>
    <section class="vh-100">
        <div class="container-fluid h-custom py-5">           
            <div class="col-md-8 col-lg-8 col-xl-5 offset-xl-1 mx-auto rounded-0 px-4 py-4 shadow bg-white">
            <div class="border-0 bg-light text-dark py-2 mb-4 w-100 rounded-0">
                <i class="fas fa-lock me-1"></i>
                Réinitialisation de mot de passe
            </div> 
                <form action="{{ route('password.reset') }}" method="post">
                    @csrf
                    <div class="form-floating my-4 w-75 mx-auto">
                        <input type="password" name="old_password" class="form-control border-0 bg-light" id="old_password" placeholder="Entrer votre mot de passe ancien" value="{{ old('old_password') }}"/>
                        <label for="old_password">Ancien mot de passe</label>                    
                    </div>
                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center text-secondary mx-3 mb-0">ENCGO</p>
                    </div>

                    <div class="form-floating my-4">
                        <input type="password" name="password" class="form-control border-0 bg-light" id="password" placeholder="Saisir le nouveau mot de passe" value="{{ old('password') }}"/>
                        <label for="password">Nouveau mot de passe</label>
                    </div>

                    <div class="form-floating my-4">
                        <input type="password" name="confirm_password" class="form-control border-0 bg-light" id="confirm_password" placeholder="Confirmer le mot de passe" value="{{ old('confirm_password') }}"/>
                        <label for="confirm_password">Confirmer le mot de passe</label>
                    </div>

                    <div class="text-center d-flex justify-content-center mt-4 py-3">
                        <button type="submit" class="btn text-white px-5 py-2" style="background-color:#B46F55;">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-master>

