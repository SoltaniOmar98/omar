@extends('etablissement.dashboard')
@section('title')
Auto Évaluation
@endsection
@section('content')
<div class="center">
    
    @if (Session::get('warning'))
    <div class="alert alert-warning">
        {{ Session::get('warning') }}
    </div>     
    @else
        <div>
            <p> Vous trouverez en ce dessous votre grille merci de remplir tous les champs</p>
            <p><h6>Titre de grille</h6> {{$grille->titre}}</p>
            <a href="/auto_eval/chapitre/{{$grille->id}}" class="btn btn-primary"> Voir les chapitres</a>
        </div>
    @endif

</div>
@endsection