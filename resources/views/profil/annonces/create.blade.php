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
        <div class="bg_form_register">
            <div class="container_form_register">
                <a class="fl_retour_register" href="{{route('main')}}">
                    <img src="/img/retour.png" alt="Précedent">
                </a>
                <a class="logo_form_register" href="{{route('main')}}">
                    <img src="/img/Poppins.png" alt="Logo-site">
                </a>
                <h2>Créer une annonce</h2>

                <form class="form_register" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titre">Que donnez-vous ?</label>
                        <input type="text" id="titre" class="form-control" name="titre" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" class="form-control" name="image" required>
                    </div>
                        @if ($errors->has('image'))
                            <div class="alert_inscrption alert-danger">
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                    <div class="form-group">
                        <label for="descriptif">Descriptif</label>
                        <textarea class="form-control" id="descriptif" name="descriptif" rows="4" placeholder="Exemple: fraise 300g"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="etat">Etat</label>
                        <div>
                            
                                <input type="radio" name="etat" value="A cueillir sois même" checked>A cueillir sois même
                            <br>
                            
                                <input type="radio" name="etat" value="Fraichement cueillis">Fraichement cueillis
                            <br>
                            
                                <input type="radio" name="etat" value="A consommer rapidement">A consommer rapidement
                        </div>
                        
                        @if ($errors->has('etat'))
                            <div class="alert_inscrption alert-danger">
                                {{ $errors->first('etat') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn_inscription">
                        Publier l'annonce
                    </button>
                </form>
            </div>
        </div>

    </body>

</html>