<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
            @section('title') 
                {{ config('app.name') }}
            @show
    </title>  

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body>
        
    <header>
        <nav>
            <div class="logo">PlantToShare</div>

            <ul>
                <li class="btn_annonce">
                    <a class="btn_create_annonce" href=""> Créer une annonce </a>
                </li>

                <li class="link_register">
                    <a class="register" href=""> S'inscrire </a>
                </li>

                <li>
                    /
                </li>

                <li class="link_login">
                    <a class="login" href=""> Se connecter </a>
                </li>
            </ul>
        </nav>
    </header>

    <div>
        @yield('content')
    </div>


    </body>

</html>
