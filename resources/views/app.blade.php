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
                    <a class="register" href="{{route('register')}}"> S'inscrire </a>
                </li>

                <li>
                    /
                </li>

                <li class="link_login">
                    <a class="login" href="{{route('login')}}"> Se connecter </a>
                </li>
            </ul>
        </nav>
    </header>

    <div>
        @yield('content')
    </div>

    <footer>
        <div class="container_content_footer">
            <div class="contain_links_footer_left">
                <a href="">Accueil |</a>
                <a href="">CGU |</a>
                <a href="">Cookies</a>
            </div>
            <div class="contain_links_footer_middle">
                <a href="">PlantToShare 2023 - Tous droits réservés |</a>
                <a href="">FAQ</a>
            </div>
            <div class="contain_links_footer_right">
                <a href=""><img class="icon_facebook" src="./img/facebook.png" alt=""></a>
                <a href=""><img src="" alt=""></a>
            </div>
        </div>
    </footer>

    </body>

</html>
