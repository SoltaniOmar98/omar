@extends('admin.dashboard')
@section('title')
List Experts
@endsection
@section('content')
<div class="center">
    @if(Session::get('succes'))
    <div class="alert alert-success">
        {{Session::get('succes')}}
    </div>
    @endif
    @if(Session::get('fail'))
    <div class="alert alert-danger">
        {{Session::get('fail')}}
    </div>
    @endif
    <div class="col-md-5 col-md-offset-4">
        <h2>Ajouter un nouveau expert</h2>
        <form action="{{ route('Save_expert') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" name="name" placeholder="Entrez le nom " value="{{old('name')}}">
                <span class="text-danger">@error('name') {{$message}} @enderror</span>

            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" placeholder="Entrez adresse mail" value="{{old('email')}}">
                <span class="text-danger">@error('email') {{$message}} @enderror</span>

            </div>
            <div class="form-group">
                <label for="phone"> Telephone </label>
                <input type="text" class="form-control" name="phone" placeholder="Entrez Numéro du téléphone" value="{{old('phone')}}">
                <span class="text-danger">@error('phone') {{$message}} @enderror</span>

            </div>
            <div class="form-group">
                <label for="adresse"> Adresse </label>
                <input type="text" class="form-control" name="adresse" placeholder="Entrez l'adresse" value="{{old('adresse')}}">
                <span class="text-danger">@error('adresse') {{$message}} @enderror</span>

            </div>
            <div class="form-group">
                <label for="adresse"> Ville </label>
                <input type="text" class="form-control" name="ville" placeholder="Entrez le ville" value="{{old('ville')}}">
                <span class="text-danger">@error('ville') {{$message}} @enderror</span>
            </div>
            <br>
            <div class="modal-footer">
                <a href="{{route('listexpert')}}" class="btn btn-light">Retour</a>
                <button type="submit" class="btn btn-success">Ajouter</button>
            </div>
        </form>
    </div>
</div>
@endsection