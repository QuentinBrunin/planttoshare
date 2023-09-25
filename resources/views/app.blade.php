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
                @auth
                    <li class="btn_annonce">
                        <a class="btn_create_annonce" href=""> Créer une annonce </a>
                    </li>
                    <li>{{ ucfirst (Auth::user()->prenom) }}.{{ substr(Auth::user()->nom, 0, 1) }}</li>
                    @else
                    <li class="link_register">
                        <a class="register" href="{{route('register')}}"> S'inscrire </a>
                    </li>
                    
                    <li class="link_login">
                        <a class="login" href="{{route('login')}}"> Se connecter </a>
                    </li>
                    <li>
                    /
                    </li>
                @endauth
            </ul>
        </nav>
    </header>

    <div>
        @yield('content')
    </div>


    </body>

</html>
