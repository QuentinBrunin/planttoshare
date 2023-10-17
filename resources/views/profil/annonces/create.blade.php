<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
            @section('title') 
                {{ config('app.name') }} : Annonce
            @show
    </title>  

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/password-toggle.js'])
    </head>
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
                        <label for="categories">Catégorie</label>
                        <select name="categorie" id="categorie" class="form-control">
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
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
                        <label for="retrait_produit">Ou retirer le don ?</label>
                        <label for="code_postal_retrait">Code Postal</label>
                        <input type="text" id="code_postal_retrait" class="form-control" name="code_postal_retrait" required autofocus value="{{ Auth::user()->code_postal }}">
                        <label for="ville_retrait">Ville</label>
                        <select class="form-control" name="ville_retrait" id="ville_retrait"  >     
                        <option >{{ Auth::user()->ville }}</option>
                    </select>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
      /* Utilisation de l'api */
$(document).ready(function(){
            const apiUrl ='https://geo.api.gouv.fr/communes?codePostal=';
            const format = '&format=json';

            let code_postal_retrait = $('#code_postal_retrait');
            let ville_retrait = $('#ville_retrait');
            let error_message = $('#error-message');

            $(code_postal_retrait).on('blur',function(){
                let code = $(this).val();
                //console.log(code);
                let url = apiUrl+code+format;
                //console.log(url);

                fetch(url,{method:'get'}).then(response => response.json()).then(results =>{
                    $(ville_retrait).find('option').remove();
                    if(results.length){
                        $(error_message).text('').hide();
                        results.forEach(value =>{
                            console.log(value.nom);
                            $(ville_retrait).append('<option value ="'+value.nom+'">'+value.nom+'</option>');
                        });
                    }else{
                        if($(code_postal_retrait).val()){
                            console.log('Erreur de code postal.');
                            $(error_message).text('Aucune commune avec ce code postal.').show();
                        }
                        else{
                            $(error_message).text('').hide();
                        }
                    }
                }).catch(err =>{
                    console.log(err);
                    $(ville_retrait).find('option').remove();
                });
            });
});
</script>
</html>