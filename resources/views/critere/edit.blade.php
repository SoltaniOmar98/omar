@extends('admin.dashboard')
@section('title')
Modifier critére
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
        <h2>Modifier chapitre</h2>
        <form action="{{route('critere.update')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$critere->id}}">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" name="titre" id="chapitre" placeholder="Entrez le nom" value="{{$critere->titre}}">
                <span class="text-danger">@error('titre') {{$message}} @enderror</span>
            </div>
            <div class="modal-footer">
                <a href="/critere/add/{{$critere->reference_id}}" class="btn btn-light">Retour</a>
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