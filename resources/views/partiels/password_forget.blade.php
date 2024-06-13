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
            max-width: 95%;
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
        <div class="container-fluid h-custom pt-5">           
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 mx-auto rounded-0 px-4 shadow bg-light mt-4">
            <div class="border-0 text-dark py-5 mb-4 w-100 rounded-0 text-center">
                <i class="fas fa-lock me-1"></i>
                Mot de passe oublier
            </div> 
                <a class="btn text-white me-2 rounded-1"  style="background-color: #B46F55;" href="{{ route('login') }}">
                    <i class="fa fa-unlock"></i>
                </a>
                <form action="{{ route('password.recap') }}" method="post">
                    @csrf

                    <div class="form-floating my-4 mx-auto">
                        <input type="text" name="email" class="form-control border-0" id="mail" placeholder="Confirmer le mot de passe" value="{{ old('email') }}"/>
                        <label for="mail">E-mail</label>
                    </div>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center text-secondary mx-3 mb-0">ENCGO</p>
                    </div>

                   
                    <div class="text-center d-flex justify-content-center my-4 py-4">
                        <button type="submit" class="btn text-white px-4 py-2" style="background-color:#B46F55;">Soumettre</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>