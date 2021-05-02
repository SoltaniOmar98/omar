@extends('etablissement.dashboard')
@section('title')
Auto Évaluation
@endsection
@section('content')
<div class="center">
    @if (Session::get('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>     
    @endif
    @if (Session::get('warning'))
    <div class="alert alert-warning">
        {{ Session::get('warning') }}
    </div>     
    @else
    <div class="container">
        <table class="table">
            <tr>
                <td class="col-2"> <p><b>Titre du grille</b>  {{$grille->titre}} </p></td>
                <td class="col-2">chapitre <a href="/auto_eval/chapitre/{{$grille->id}}"> {{$chapitre->titre}}</a> </td>
                <td class="col-2"> domaine <a href="/auto_eval/domaine/{{$chapitre->id}}"> {{$domaine->titre}}</a> </td>
                <td class="col-2"> reference <a href="/auto_eval/references/{{$domaine->id}}"> {{$ref->titre}}</a> </td>
                <td class="col-4">
                    <form action="  " method="get">
                        <div class="input-group">
                            <input type="hidden" name="id" value="{{ $domaine->id }}">
                            <input type="text" class="form-control" aria-label="Recherche" placeholder="recherche"
                                name="search">
                            <span class="input-group-text"><button class="btn_search" type="submit">
                                    <img src="https://img.icons8.com/material-two-tone/24/000000/search.png" /></button>
                            </span>
                        </div>
                    </form>
                </td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    
                    <th class="col-6">Critére</th>
                    <th class="col-6">Note</th>
                </tr>
            </thead>
        </table>
                <form action=" {{ url('/auto_eval/note') }} " method="post">
                    @csrf
                    @foreach ($critere as $item)
                    <div class="row">
                        <input type="hidden" name="id[]
                            " value="{{$item->id}}">
                        <div class="col-6">
                            {{$item->titre}}
                        </div>
                        <div class="col-6">
                            <input type="text" name="note" placeholder="Entrer note">
                            <span class="text-danger">@error('note') {{$message}} @enderror</span>
                        </div>
                    </div>
                    @endforeach
                    <div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>

                    </div>
                </form>
            
        
    </div>
    @endif
</div>
@endsection