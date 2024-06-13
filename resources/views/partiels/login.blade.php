<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('img/ENCGO.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <title>Connexion</title> 
    <style>
        #img1{
            position: absolute;
            right: 0%;
            width: 23%;
            height: 25%;
        }
        #img2{
            position: absolute;
            bottom: 0%;
            left: 0%;
            width: 23%;
            height: 25%;
        }
        .form-control:focus {
            border-color: initial;
            box-shadow: none;
            outline: none;
        }
    </style>
</head>
<body>
    <img class="imaged" src="{{ asset('img/d.png') }}" alt="" id="img1"/>
    <img class="imageg" src="{{ asset('img/g.png') }}" alt="" id="img2"/>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 text-center mb-4 mt-4">
                <img class="logo " src="{{ asset('img/encgo_logo.png') }}" alt="ENSG OUJDA" width="50%"/>
            </div>
        </div>
        <div class="row justify-content-center py-4">
            <div class="col-md-4">
                <div class="form-container border py-4 px-5">
                    <h2 class="mb-3 text-center">Connexion</h2>
                    <br />
                    <form action="{{ route('auth') }}" method="post">
                        @csrf
                        <div class="form-floating">
                            <input type="text" name="email" class="form-control border-0 border-bottom border-dark" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}"/>
                            <label for="floatingInput">E-mail address</label>
                        </div>
                        @error('email')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="password" name="password" class="form-control border-0 border-bottom border-dark shadow-bottom-custom" id="floatingPassword" placeholder="mot de passe"/>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="mt-2 text-end">
                            <a class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ route('password.forget') }}">Mot de passe oublié ?</a>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-dark btn-block w-100 ">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
