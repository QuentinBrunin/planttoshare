@extends('profil.dashboard')
@section('content')
    <h2>Mes annonces</h2>
    @if(session('successSupression'))
        <div class="alert alert-success">
            {{ session('successSupression') }}
        </div>
    @endif

    @if(session('succes_create_annonce'))
        <div class="alert alert-success">
            {{ session('succes_create_annonce') }}
        </div>
    @endif
    @if(session('succes_update_annonce'))
        <div class="alert alert-success">
            {{ session('succes_update_annonce') }}
        </div>
    @endif


    <ul>
        @foreach ($annonces as $annonce)
            <li>
                <h2>{{$annonce->titre}}</h2>
                <p>{{$annonce->descriptif}}</p>
                <p>{{$annonce->etat}}</p>
                <img style="width: 25vh" src="{{ asset('/storage/' . $annonce->image) }}" alt="Image de l'annonce">
                <a  class="js-modal-delete" data-annonce-id="{{$annonce->id}}">Supprimer</a>
                <a  class="js-modal" data-annonce-id="{{$annonce->id}}">modifier</a>
        
                <aside id="modaldelete-{{$annonce->id}}" class="modaldelete" aria-hidden="true" role="dialog" aria-labelledby="titlemodaldelete" >
                    <div class="modal-wrapper-delete" >
                        <h2>Confirmation de suppression</h2>
                        <p>Voulez-vous vraiment supprimer cette annonce ?</p>
                        <button id="confirm-delete" data-annonce-id="{{$annonce->id}}">Supprimer</button>
                        <button id="cancel-delete" data-annonce-id="{{$annonce->id}}">Annuler</button>
                    </div>
                </aside>

                
                    <aside id="modal-{{$annonce->id}}" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none">
                        <div class="modal-wrapper">
            
                            <a href="#" class="close-modal" data-annonce-id="{{$annonce->id}}">X</a>
                            <h2 id="titlemodal">Modifier mon annonce</h2>
                            <form class="form_annonce_update" method="POST" enctype="multipart/form-data" action="{{ route('modifierAnnonce', ['annonce' => $annonce->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group-update">
                                    <label for="titre">Que donnez-vous ?</label>
                                    <input type="text" id="titre" class="form-control-update" name="titre" required autofocus value="{{ old('titre', $annonce->titre) }}">
                                </div>
                                <div class="form-group">
                                    <label for="categories">Catégorie</label>
                                    <select name="categorie" id="categorie" class="form-control">
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group-update">
                                    <label for="image">Image</label>
                                    <input type="file" id="image" class="form-control-update" name="image" accept="image/*" onchange="previewImage(this.$annonce(id));">
                                    <img class="image_pre" id="image-preview-{{$annonce->id}}" style="width: 25vh" src="{{ asset('/storage/' . $annonce->image) }}" alt="Image de l'annonce">
                                </div>
                                <div class="form-group-update">
                                    <label for="descriptif">Descriptif</label>
                                    <textarea class="form-control-update" id="descriptif" name="descriptif" rows="4">{{ old('descriptif', $annonce->descriptif) }}</textarea>
                                </div>
                                <div class="form-group_update">
                                    <label for="retrait_produit">Ou retirer le don ?</label>
                                    <label for="code_postal_retrait">Code Postal</label>
                                    <input type="text" id="code_postal_retrait" class="form-control" name="code_postal_retrait" required autofocus value="{{ old('code_postal_retrait', $annonce->code_postal_retrait) }}">
                                    <label for="ville_retrait">Ville</label>
                                    <select class="form-control" name="ville_retrait" id="ville_retrait"  >     
                                    <option >{{ old('ville_retrait', $annonce->ville_retrait) }}</option>
                                </select>
                                </div>
                                <div class="form-group-update">
                                    <label for="etat">Etat</label>
                                    <div>
                                        <input type="radio" name="etat" value="A cueillir sois même" {{ $annonce->etat == 'A cueillir sois même' ? 'checked' : '' }}>A cueillir sois même<br>
                                        
                                        <input type="radio" name="etat" value="Fraichement cueillis" {{ $annonce->etat == 'Fraichement cueillis' ? 'checked' : '' }}>Fraichement cueillis<br>
                                        
                                        <input type="radio" name="etat" value="A consommer rapidement" {{ $annonce->etat == 'A consommer rapidement' ? 'checked' : '' }}>A consommer rapidement
                                    </div>
                                </div>
                            <button type="submit" class="btn_valider_modif">
                                Modifier l'annonce
                            </button>
                            </form>
                
                        </div>
                    
                    </aside>
                
            </li>
        @endforeach

            <li class="create-annonce-profil"><a class="btn_create_annonce_profil" href="{{ route('createAnnonce')}}">Créer une annonce</a></li>
    </ul>
    
<script>
    
    
document.addEventListener('DOMContentLoaded', function() {
  // Fonction pour ouvrir la modal
    function openModal(annonceId) {
        var modal = document.getElementById('modal-' + annonceId);
        modal.style.display = 'block';
    }

  // Fonction pour fermer la modal
    function closeModal(annonceId) {
        var modal = document.getElementById('modal-' + annonceId);
        modal.style.display = 'none';
    }

  // Attacher un gestionnaire d'événement à chaque bouton "modifier"
    var modalTriggerButtons = document.querySelectorAll('.js-modal');
    modalTriggerButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var annonceId = this.getAttribute('data-annonce-id');
            openModal(annonceId);
        });
    });

  // Fermer la modal lorsque l'utilisateur clique en dehors de celle-ci
    window.addEventListener('click', function(event) {
        modalTriggerButtons.forEach(function(button) {
            var annonceId = button.getAttribute('data-annonce-id');
            var modal = document.getElementById('modal-' + annonceId);
            if (event.target === modal) {
                closeModal(annonceId);
                window.location.replace("/profil/annonces");
            }
        });
    });

  // Attacher un gestionnaire d'événement à chaque bouton "fermer la modal"
    var closeButton = document.querySelectorAll('.close-modal');
    closeButton.forEach(function(button) {
        button.addEventListener('click', function(event) {
          event.preventDefault(); // Empêche le lien de suivre le href
            var annonceId = this.getAttribute('data-annonce-id');
            closeModal(annonceId);
            window.location.replace("/profil/annonces");
        });
    });

    // afficher l'image modifier dans le formulaire
    function previewImage(input) {
        const imagePreview = document.getElementById("image-preview");

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
});

// afficher l'image modifier dans le formulaire

function previewImage(input, imageId) {
    const imagePreview = document.getElementById('image-preview-' + imageId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            imagePreview.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}

    </script>
        
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour ouvrir la modal de confirmation de suppression
    function openDeleteModal(annonceId) {
        const modal = document.getElementById('modaldelete-' + annonceId);
        modal.style.display = 'block'; // Affiche la modal au clic sur "Supprimer"
    }

    // Fonction pour fermer la modal de confirmation de suppression
    function closeDeleteModal(annonceId) {
        const modal = document.getElementById('modaldelete-' + annonceId);
        modal.style.display = 'none'; // Masque la modal au clic sur "Annuler" ou "Supprimer"
        window.location.replace("/profil/annonces");
    }

    // Gestionnaire d'événements pour le bouton "Supprimer" dans la modal de chaque annonce
    const deleteButtons = document.querySelectorAll('.js-modal-delete');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const annonceId = this.getAttribute('data-annonce-id');
            openDeleteModal(annonceId);
        });
    });

    // Gestionnaire d'événements pour le bouton "Annuler" dans la modal de confirmation de suppression
    const cancelDeleteButton = document.querySelectorAll('#cancel-delete');
    cancelDeleteButton.forEach(function(button) {
        button.addEventListener('click', function() {
            const annonceId = this.getAttribute('data-annonce-id');
            closeDeleteModal(annonceId);
        });
    });

    // Gestionnaire d'événements pour le bouton "Supprimer" dans la modal de confirmation de suppression
    const confirmDeleteButton = document.querySelectorAll('#confirm-delete');
    confirmDeleteButton.forEach(function(button) {
        button.addEventListener('click', function() {
            const annonceIdToDelete = this.getAttribute('data-annonce-id');
            
            //Requête AJAX pour supprimer l'annonce
            fetch(`/annonces/supprimer/${annonceIdToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}', 
            },
        });
            closeDeleteModal(annonceIdToDelete); 
        });
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    /*Utilisation de l'api */
$(document).ready(function(){
    const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
    const format = '&format=json';

    // Sélectionnez tous les éléments code_postal_retrait et ville_retrait
    var code_postal_retraits = document.querySelectorAll('[id^="code_postal_retrait"]');
    var ville_retraits = document.querySelectorAll('[id^="ville_retrait"]');
    var error_messages = document.querySelectorAll('[id^="error-message"]');

    code_postal_retraits.forEach(function (code_postal_retrait, index) {
        var ville_retrait = ville_retraits[index];
        var error_message = error_messages[index];

        $(code_postal_retrait).on('blur', function () {
            let code = $(this).val();
            let url = apiUrl + code + format;

            fetch(url, { method: 'get' })
                .then(response => response.json())
                .then(results => {
                    $(ville_retrait).find('option').remove();
                    if (results.length) {
                        $(error_message).text('').hide();
                        results.forEach(value => {
                            $(ville_retrait).append('<option value="' + value.nom + '">' + value.nom + '</option>');
                        });
                    } else {
                        if ($(code_postal_retrait).val()) {
                            console.log('Erreur de code postal.');
                            $(error_message).text('Aucune commune avec ce code postal.').show();
                        } else {
                            $(error_message).text('').hide();
                        }
                    }
                })
                .catch(err => {
                    console.log(err);
                    $(ville_retrait).find('option').remove();
                });
        });
    });
});

</script>
@endsection