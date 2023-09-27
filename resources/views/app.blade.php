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
                    <li class="btn_annonce"><a class="btn_create_annonce" href="">Créer une annonce</a></li>
                    <a onclick="openMenuDrop()" href="#" id="openMenu" class="menu_dropdown  "> {{ucfirst(auth()->user()->prenom) }}.{{ ucfirst(auth()->user()->nom[0]) }} </a>
                        <div id="myMenuDropDown" class="user-dropdown">
                            <img onclick="closeMenuDrop()" src="./img/croix.png" alt="Fermetture du menu" class="close" id="closeMenu">
                            <ul>
                                <li><a href="#">Mon profil</a></li>
                                <li><a href="#">Mes annonces</a></li>
                                <li><a href="#">Messagerie</a></li>
                                <hr>
                                <li><a href="{{ route('logout') }}">Déconnexion</a></li>
                            </ul>
                        </div>
            @else
                <li class="btn_annonce"><a class="btn_create_annonce" href="#">Créer une annonce</a></li>
                <li><a href="{{ route('register') }}">S'inscrire </a></li>
                <li> / </li>
                <li><a href="{{ route('login') }}">Se connecter</a></li>
            @endauth
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
