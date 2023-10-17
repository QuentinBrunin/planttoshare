@extends ('app')

@section ('content')
<div class="img-menu-filter">
    <a href="{{ route('getFilteredAnnonces', ['category' => 'plantes']) }}" class="category-link" data-category="plantes"><img class="img-filter" src="./img/plante.png" alt="accés plantes"></a>
    <a href="{{ route('getFilteredAnnonces', ['category' => 'legumes']) }}"class="category-link" data-category="legumes"><img class="img-filter" src="./img/des-legumes.png" alt="accés légumes"></a>
    <a href="{{ route('getFilteredAnnonces', ['category' => 'fruits']) }}" class="category-link" data-category="fruits"><img class="img-filter" src="./img/des-fruits.png" alt="accés fruits"></a>
    <a href="{{ route('getFilteredAnnonces', ['category' => 'graines']) }}" class="category-link" data-category="graines"><img class="img-filter" src="./img/cultiver-des-graines.png" alt="accés graines"></a>
</div>

<div class="container-filter">
    <div class="filter">
        <form action="">
            <label for="adresse">Adresse</label>
            
        </form>
    </div>
    <div id="filtered-annonces" class="annonces-result">
        @foreach($annonces as $annonce)
            <div class="gr-img-result" data-category="{{$annonce->categorie->nom}}">
                <img class="img-result" src="{{ asset('/storage/' . $annonce->image) }} " alt="{{$annonce->tire}}">
                <h3 class="title-img-result">{{$annonce->titre}}</h3>
            </div>
        @endforeach
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.category-link').click(function(e) {
        e.preventDefault();
        var category = $(this).data('category');
        
        // Vous devrez envoyer une requête Ajax au serveur pour récupérer les annonces filtrées par catégorie
        $.get('/getFilteredAnnonces/' + category, function(data) {
            // Mettez à jour le contenu de la section des annonces filtrées
            $('#filtered-annonces').empty();
            data.forEach(function(annonce) {
                var annonceElement = $('<div class="annonce-item">' +
                    '<img class="img-result" src="' + '{{ asset("storage/") }}' + '/' + annonce.image + '" alt="' + annonce.titre + '">' +
                    '<h3>' + annonce.titre + '</h3>' +
                    '</div>');
                $('#filtered-annonces').append(annonceElement);
            });
        });
    });
});
</script>
