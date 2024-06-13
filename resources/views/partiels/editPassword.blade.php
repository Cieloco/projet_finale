<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('img/ENCGO.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <title>Password Reset</title> 
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .h-custom {
            height: calc(100% - 73px);
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
        <div class="container-fluid h-custom pt-4">           
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 mx-auto rounded-0 px-4 py-3 shadow bg-light mt-4">
            <div class="border-0 text-dark py-2 mb-4 w-100 rounded-0">
                <i class="fas fa-lock me-1"></i>
                Réinitialisation de mot de passe
            </div> 
                <form action="{{ route('password.confirm') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}"/>
                    <input type="hidden" name="hashedChain" value="{{ $hashedChain }}"/>
                    <div class="mx-auto my-4">
                        <input type="text" name="randomType" class="form-control border-0 border-bottom rounded-0 rounded-top-2 py-3" placeholder="Saisir la chaîne aléatoire que nous vous avons envoyée" value="{{ old('randomType') }}"/>
                    </div>
                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center text-secondary mx-3 mb-0">ENCGO</p>
                    </div>

                    <div class="form-floating my-4">
                        <input type="password" name="password" class="form-control border-0" id="password" placeholder="Saisir le nouveau mot de passe" value="{{ old('password') }}"/>
                        <label for="password">Nouveau mot de passe</label>
                    </div>

                    <div class="form-floating my-4">
                        <input type="password" name="confirm_password" class="form-control border-0" id="confirmation" placeholder="Confirmer le mot de passe" value="{{ old('confirm_password') }}"/>
                        <label for="confirmation">Confirmer le mot de passe</label>
                    </div>

                    <div class="text-center d-flex justify-content-end mt-4 py-3">
                        <button type="submit" class="btn text-white px-3" style="background-color:#B46F55;">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>

