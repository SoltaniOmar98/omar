@extends('admin.dashboard')
@section('title')
Modifier établissements
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
        <h2>Modifier utilisateur</h2>
        <form action="{{route('update_etab')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$etab->id}}">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" name="name" id="user_name" placeholder="Entrez le nom" value="{{$etab->name}}">
                <span class="text-danger">@error('name') {{$message}} @enderror</span>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" id="user_email" placeholder="Entrez adresse mail" value="{{$etab->email}}">
                <span class="text-danger">@error('email') {{$message}} @enderror</span>

            </div>
            <div class="form-group">
                <label for="phone"> Telephone </label>
                <input type="text" class="form-control" name="phone" id="user_phone" placeholder="Entrez Numéro du téléphone" value="{{$etab->phone}}">
                <span class="text-danger">@error('phone') {{$message}} @enderror</span>
            </div>
            <div class="form-group">
                <label for="adresse"> Adresse </label>
                <input type="text" class="form-control" name="adresse" id="user_adresse" placeholder="Entrez l'adresse" value="{{$etab->adresse}}">
                <span class="text-danger">@error('adresse') {{$message}} @enderror</span>
            </div>
            <div class="form-group">
                <label for="adresse"> Ville </label>
                <input type="text" class="form-control" name="ville" id="user_ville" placeholder="Entrez le ville" value="{{$etab->ville}}">
                <span class="text-danger">@error('ville') {{$message}} @enderror</span>
            </div>


            <div class="modal-footer">
                <a href="{{route('index')}}" class="btn btn-light">Retour</a>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ConfirmModal">Modifier</button>
            </div>
            <!-- ------------------------ Start Modal Confirmation ---------------------------------- -->
            <div class="modal fade" id="ConfirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Voulez-vous modifier
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">Confirmer</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection