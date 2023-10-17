@extends('profil.dashboard')

@section ('content')


        @if(session('message_complete_profil'))
        <div class="alert alert-success">
            {{ session('message_complete_profil') }}
        </div>
        @endif
    @if (session('succes_update_profil'))
        <div class="alert alert-success">
            {{ session('succes_update_profil') }}
        </div>
    @endif

    <h2 class="monProfil">Mon profil</h2>
    <div style="display: none; color:#f55;text-align:center;" id="error-message"></div>
    <div class="container-profil">
        <div class="formulaire-profil">
            <h3>Informations personnelles</h3>
            <form class="form_profil" method="POST" enctype="multipart/form-data" action="{{ route('modifierProfil', ['user' => $user->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-group-profil">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" id="pseudo" class="form-control-profil" name="pseudo" autofocus value="{{ Auth::user()->pseudo }}" >
                </div>
                <div class="form-group-profil">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" class="form-control-profil" name="nom" readonly required autofocus value="{{ Auth::user()->nom }}">
                </div>
                <div class="form-group-profil">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" class="form-control-profil" name="prenom" readonly required autofocus value="{{ Auth::user()->prenom }}">
                </div>
                <div class="form-group-profil">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control-profil" name="email" readonly required autofocus value="{{ Auth::user()->email }}">
                </div>
                <div class="form-group-profil">
                    <label for="adresse">Adresse</label>
                    <input type="text" id="adresse" class="form-control-profil" name="adresse" required autofocus value="{{ Auth::user()->adresse }}">
                </div>

                <div class="form-group-profil">
                    <label for="code_postal">Code Postal</label>
                    <input type="text" id="code_postal" class="form-control-profil" name="code_postal" required autofocus value="{{ Auth::user()->code_postal }}">
                </div>
                
                <div class="form-group-profil">
                    <label for="ville">Ville</label>
                    <select class="form-control-profil-select" name="ville" id="ville"  >     
                        <option >{{ Auth::user()->ville }}</option>
                    </select>
                
                </div>

                <button type="submit" class="btn_profil">
                    Enregistrer mes modifications
                </button>
        </div>

            <div class="modifier-avatar">
                <div class="form-group-profil-avatar">
                    <label for="avatar" style="display: none">Avatar</label>
                    <img id="selected-avatar-preview" src="{{ asset('img/avatar/' . Auth::user()->photo_profil) }}" alt="Avatar de l'utilisateur"  >

                    <a href="#modal-avatar" class="js-modal-avatar">Choisir un avatar</a>
                    
                    <div id="modal-avatars" class="modal-avatar" aria-hidden="true" role="dialog" aria-labelledby="titlemodalavatar">
                        <div class="modal-wrapper-avatars">
                            <a href="#" class="close-modal-avatars">X</a>
                            <h2 id="titlemodalavatar">Sélectionner un avatar</h2>
                            <div class="avatar-options">
                                <label for="avatar1">
                                    <input type="radio" name="photo_profil" value="avatar1.png" id="avatar1">
                                    <img src="../img/avatar/avatar1.png" alt="Avatar 1" class="avatar-image" style="width: 10%">
                                </label>
                                <label for="avatar2">
                                    <input type="radio" name="photo_profil" value="avatar2.png" id="avatar2">
                                    <img src="../img/avatar/avatar2.png" alt="Avatar 2" class="avatar-image" style="width: 10%">
                                </label>
                                <label for="avatar3">
                                    <input type="radio" name="photo_profil" value="avatar3.png" id="avatar3">
                                    <img src="../img/avatar/avatar3.png" alt="Avatar 3" class="avatar-image" style="width: 10%">
                                </label>
                                <label for="avatar4">
                                    <input type="radio" name="photo_profil" value="avatar4.png" id="avatar4">
                                    <img src="../img/avatar/avatar4.png" alt="Avatar 4" class="avatar-image" style="width: 10%">
                                </label>
                                <label for="avatar5">
                                    <input type="radio" name="photo_profil" value="avatar5.png" id="avatar5">
                                    <img src="../img/avatar/avatar5.png" alt="Avatar 5" class="avatar-image" style="width: 10%">
                                </label>
                                <label for="avatar6">
                                    <input type="radio" name="photo_profil" value="avatar6.png" id="avatar6">
                                    <img src="../img/avatar/avatar6.png" alt="Avatar 6" class="avatar-image" style="width: 10%">
                                </label>
                                <label for="avatar7">
                                    <input type="radio" name="photo_profil" value="avatar7.png" id="avatar7">
                                    <img src="../img/avatar/avatar7.png" alt="Avatar 7" class="avatar-image" style="width: 10%">
                                </label>
                                <label for="avatar8">
                                    <input type="radio" name="photo_profil" value="avatar8.png" id="avatar8">
                                    <img src="../img/avatar/avatar8.png" alt="Avatar 8" class="avatar-image" style="width: 10%">
                                </label>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    /* Utilisation de l'api */
$(document).ready(function(){
            const apiUrl ='https://geo.api.gouv.fr/communes?codePostal=';
            const format = '&format=json';

            let code_postal = $('#code_postal');
            let ville = $('#ville');
            let error_message = $('#error-message');

            $(code_postal).on('blur',function(){
                let code = $(this).val();
                //console.log(code);
                let url = apiUrl+code+format;
                //console.log(url);

                fetch(url,{method:'get'}).then(response => response.json()).then(results =>{
                    $(ville).find('option').remove();
                    if(results.length){
                        $(error_message).text('').hide();
                        results.forEach(value =>{
                            console.log(value.nom);
                            $(ville).append('<option value ="'+value.nom+'">'+value.nom+'</option>');
                        });
                    }else{
                        if($(code_postal).val()){
                            console.log('Erreur de code postal.');
                            $(error_message).text('Aucune commune avec ce code postal.').show();
                        }
                        else{
                            $(error_message).text('').hide();
                        }
                    }
                }).catch(err =>{
                    console.log(err);
                    $(ville).find('option').remove();
                });
            });
});
        
/*modales*/        
    document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour ouvrir la modal
    function openModal() {
        var modal = document.getElementById('modal-avatars');
        modal.style.display = 'block';
    }

    // Fonction pour fermer la modal
    function closeModal() {
        var modal = document.getElementById('modal-avatars');
        modal.style.display = 'none';
    }

    // Fonction pour gérer la sélection d'avatar
    function handleAvatarSelection(event) {
    var selectedAvatar = event.target;
    var avatarOptions = document.querySelectorAll('.avatar-image');
    var selectedAvatarPreview = document.getElementById('selected-avatar-preview');

    // Supprimer la classe "selected-avatar" de tous les avatars
    avatarOptions.forEach(function(avatar) {
        avatar.classList.remove('selected-avatar');
    });

    // Ajouter la classe "selected-avatar" à l'avatar sélectionné
    selectedAvatar.classList.add('selected-avatar');

     // Mettre à jour la source de l'image avec l'URL de l'avatar sélectionné
    selectedAvatarPreview.src = selectedAvatar.src;
    
}

    // Attacher un gestionnaire d'événement au lien pour ouvrir la modal
    var modalTriggerButton = document.querySelector('.js-modal-avatar');
    modalTriggerButton.addEventListener('click', function(event) {
        event.preventDefault(); // Empêche le lien de suivre le href
        openModal();
    });

    // Attacher un gestionnaire d'événement au bouton pour fermer la modal
    var closeButton = document.querySelector('.close-modal-avatars');
    closeButton.addEventListener('click', function(event) {
        event.preventDefault(); // Empêche le lien de suivre le href
        closeModal();
    });
    // Attacher un gestionnaire d'événement à chaque avatar pour gérer la sélection
var avatarOptions = document.querySelectorAll('.avatar-image');
avatarOptions.forEach(function(avatar) {
    avatar.addEventListener('click', handleAvatarSelection);
});
});

</script>