@extends ('app')

@section('content')
<div class="annonce-show-container">
    <div class="details-annonce-show">
        
            <img class="annonce-img" src="{{ asset('/storage/' . $annonce->image) }}" alt="Image de l'annonce">
            <p>{{$annonce->titre}}</p>
            <p>{{$annonce->categorie->nom}}</p>
            <p>{{$annonce->descriptif}}</p>
            <p><img src="{{asset('/img/localisation.png')}}" style="width: 4%" alt="">{{$annonce->ville_retrait}}</p>
        
    </div>
    <div class="contact-donnateur">
        <div class="info-donnateur">
            <img src="{{ asset('img/avatar/' . $annonce->auteur_avatar) }}" alt="Avatar de l'auteur">
            <p> <strong>{{$annonce->auteur_nom}}</strong> <br> Membre depuis le <br>{{$annonce->auteur_membre_depuis->format('Y-m-d')}}</p>
        </div>
        
    </div>
</div>
@endsection
