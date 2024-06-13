<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation de compte</title>
    <link rel="shortcut icon" href="{{ asset('img/phase_two.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        /* Ajouter des styles personnalisés */
        body {
            background-color: #fff;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #F9FBFF;
            padding: 30px;
            cursor: default;
        }
        main {
            background-color: #fff;
            padding: 5% 4%;
        }
        a.btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #001F33;
            color: #fff;
            transition: all 0.2s linear;
        }
        .btn:hover {
            background-color: #E0F4FF;
            color: #001F33;   
            border: lightblue solid 2px;
        }
        img {
            width: 22%;
            position: relative;
        }
        .mail {
            width: 38%;
            height: 20%;
        }

        .hr {
            width: 100%;
            height: 4px;
            margin-top: 14%;
            background-color: lightblue;
        }
        
    </style>
</head>
<body>
    <div class="container text-center rounded-0 shadow-sm pt-2 pb-5">
        <header class="d-flex justify-content-between p-0">
            <img src="{{ asset('img/phase_one.png') }}" class="mail" alt="mail">
            <img src="{{ asset('img/phase_two.png') }}" alt="Logo">
        </header>
        <div class="hr"></div>
        <main class="shadow-sm rounded-3 fs-5">
            <h3 class="text-start text-primary-emphasis mb-5 text-center">Votre compte est activé! M(me). <br />  {{ $user->name.' '.$user->prenom }}</h3>
            <p>Merci d'avoir activé votre compte.</p>
            <a href="{{ route('login') }}" class="btn">Se connecter</a>
        </main>
    </div>
</body>
</html>