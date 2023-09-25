<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
            @section('title') 
                {{ config('app.name') }} : Inscription
            @show
    </title>  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/password-toggle.js'])
    </head>

    <body>
    <div class="bg_form_register">
        <div class="container_form_register">
            <a class="fl_retour_register" href="{{route('main')}}">
                <img src="./img/retour.png" alt="Précedent">
            </a>
            <a class="logo_form_register" href="{{route('main')}}">
                <img src="./img/Poppins.png" alt="Logo-site">
                </a>
                <h2>Formulaire d'Inscription</h2>
            <form class="form_register" method="POST"action="/register">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" class="form-control" name="nom" placeholder="Nom" required autofocus>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" class="form-control" name="prenom" placeholder="Prénom" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" name="email"  placeholder="plantation@example.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="password-container">
                        <input type="password" id="password" class="form-control" name="password" placeholder="8 Caractères minimum">
                        <i id="togglePassword" class="fas fa-eye"></i>
                    </div>
                </div>
                    @if ($errors->has('password'))
                        <div class="alert_inscrption alert-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                <button type="submit" class="btn_inscription">
                    Inscris toi
                </button>
                <p class="text_register">Tu as déja un compte ?<a href="/login"> Connecte-toi !</a></p>
            </form>

        </div>
    </div>
    </body>
</html>