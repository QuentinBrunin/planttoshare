@extends ('admin.index')

@section ('content')
    @if (session('succes_update_annonce'))
        <div class="alert alert-success">
            {{ session('succes_update_annonce') }}
        </div>
    @endif

    @if(session('successSupression'))
        <div class="alert alert-success">
            {{ session('successSupression') }}
        </div>
    @endif

    @if(session('errorSupression'))
        <div class="alert alert-success">
            {{ session('errorSupression') }}
        </div>
    @endif
    <h2>Mon profil Admin</h2>

@endsection