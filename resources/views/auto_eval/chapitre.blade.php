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
    <div class="container">
        <form action="{{ url('/chapitre/get') }}" method="get">
            <div class="input-group">
                <input type="hidden" name="id" value="{{ $grille->id }}">
                <input type="text" class="form-control" aria-label="Recherche" placeholder="recherche"
                    name="search">
                <span class="input-group-text"><button class="btn_search" type="submit">
                        <img src="https://img.icons8.com/material-two-tone/24/000000/search.png" /></button>
                </span>
            </div>
        </form>

        <div class="row">
            @foreach ($chapitres as $item)
                <div class="col-md-3">
                    <br>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->titre }}</h5>
                            <p class="card-text">
                            </p>
                            <div class="btn-group">
                                <a href="/auto_eval/domaine/{{$item->id}}" class="btn btn-primary">domaines</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection