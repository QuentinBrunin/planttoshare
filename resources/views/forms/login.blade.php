<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
            @section('title') 
                {{ config('app.name') }} : Connexion
            @show
    </title>  

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/password-toggle.js'])

    <body>
        <div class="bg_form_login">
            <div class="container_form_login">
                <a class="fl_retour_register" href="{{route('main')}}">
                <img src="./img/retour.png" alt="Précedent">
            </a>
                <a class="logo_form_login" href="{{route('main')}}">
                <img src="./img/Poppins.png" alt="Logo-site">
                </a>
                <h2>Formulaire de Connexion</h2>
                <form class="form_login" method="POST" action="/login">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="plantation@example.com" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <div class="password-container">
                                <input type="password" id="password" class=" input_password form-control" name="password" placeholder="8 Caractères minimum">
                                <i id="togglePassword" class=" login_eye fas fa-eye"></i>
                            </div>
                    </div>
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <button type="submit" class="btn_connexion">
                            Connexion
                        </button>
                        <p class="text_login">Tu n'as pas de compte?<a href="/register"> Inscris-toi !</a></p>
                </form>
            </div>
        </div>


    </body>

</html>




