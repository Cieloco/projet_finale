
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation de compte</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/phase_two.png') }}" type="image/x-icon">
    <style>
        /* Ajouter des styles personnalisés */
        .container {
            font-family: Nunito, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: larger;
            max-width: 42%;
            margin: auto;
            color: #333;
            padding: 20px;
            background-color: #fff;
            cursor: default;
        }
        a.btn {
            display: block;
            width: fit-content;
            margin: 30px auto;
            cursor: pointer;
            background-color: #001F33;
            color: #fff;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
        }
        h2 {
            color: #001F33;
            margin: 25px auto;
        }
        hr {
            border: 0.0.1cm solid #333;
        }
        a.btn:hover {
            background-color: #333;
        }
        .support {
            color: #333;
            cursor: pointer;
            text-decoration: none;
        }
        .support:hover {
            color: #B46F55;
        }
        img {
            width: 30%;
            height: 15%;
            position: relative;
        }

        .hr {
            width: 100%;
            height: 3px;
            background-color: #B46F55;
        }
    </style>
</head>
<body>
    <div class="container text-center pt-3 pb-1">
        <header class="d-flex justify-content-start p-0">
            <img src="https://th.bing.com/th/id/OIP.c5lhjSuEhHTyGjDqaL-dUwAAAA?rs=1&pid=ImgDetMain" alt="Logo">
        </header>
        <div class="hr"></div>
        <h2>Bienvenue, M(me). {{ $name.' '.$prenom }}!</h2>
        <p>Vous avez été ajouté récemment par l'administrateur de l'ENSGO. Pour activer votre compte, veuillez cliquer sur le bouton d'activation ci-dessous :</p>
        <a href="{{ $link }}" class="btn">Activer votre compte</a>
        <footer>
            <hr  />
            <p>Pour toute assistance, veuillez nous contacter à <a class="support" href="mailto:support.encgo@gmail.com">support.encgo@gmail.com</a></p>
        </footer>
    </div>
</body>
</html>
