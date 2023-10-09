@extends ('admin.index')

@section ('content')
    @if (session('succes_update_profil'))
        <div class="alert alert-success">
            {{ session('succes_update_profil') }}
        </div>
    @endif

    <h2 class="monProfil">Mon profil</h2>
    <div class="container-profil">
        <form class="form_profil" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="Nom">Nom</label>
                <input type="text" id="Nom" class="form-control" name="nom" readonly required autofocus value="{{ Auth::user()->nom }}">
            </div>
            <div class="form-group">
                <label for="titre">Prénom</label>
                <input type="text" id="Prénom" class="form-control" name="prenom" readonly required autofocus value="{{ Auth::user()->prenom }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" name="email" readonly required autofocus value="{{ Auth::user()->email }}">
            </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" class="form-control" name="adresse" required autofocus value="{{ Auth::user()->adresse }}">
            </div>

            <div class="form-group">
                <label for="codePostal">Code Postal</label>
                <input type="text" id="codePostal" class="form-control" name="code_postal" required autofocus value="{{ Auth::user()->code_postal }}">
            </div>
            
            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" id="ville" class="form-control" name="ville" required autofocus value="{{ Auth::user()->ville }}">
            </div>
            
            <div class="form-group">
                <label for="Avatar">Avatar</label>
                <input type="file" id="image" class="form-control" name="image" accept="image/*" onchange="previewImage(this);">
            </div>
            <div class="form-group">
                <label for="nbTrock">Nombre de don</label>
                <input type="text" id="nbTrock" class="form-control" name="nbTrock" readonly required autofocus value="{{ Auth::user()->nb_trock }}">
            </div>

            <button type="submit" class="btn_profil">
                Modifier mon profil
            </button>

        </form>
    </div>

@endsection