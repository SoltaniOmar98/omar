@extends('admin.dashboard')
@section('title')
    modifier grille
@endsection
@section('content')
    @if (Session::get('succes'))
        <div class="alert alert-success">
            {{ Session::get('succes') }}
        </div>
    @endif
    @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif

    <div class="center">
        <div class="col-md-5 col-md-offset-4">
            <h2>modifiez grille</h2>
            <form action="{{Route('grille.update')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$grille->id}}">

                    <label>Titre</label>
                    <input type="text" class="form-control" name="titre" placeholder="Entrez titre de grille " value="{{$grille->titre}}">
                    <span class="text-danger">@error('titre') {{$message}} @enderror</span>
                </div>
                    <br>
                <div class="form-group">
                    <label for="">Établissement</label>
                    <select name="id_etab" id="" class="form-select" value="{{$grille->titre}}">
                    @foreach($etab as $i)
                    <option value="{{$i->id}}">{{$i->name}}</option>
                    @endforeach
                    </select>
                </div>
                <br>
    
                <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Modifier</button>
                </div>
            </form>
        </div>
    
    </div>
@endsection