@extends('admin.dashboard')
@section('title')
List etablissement
@endsection
@section('content')
<div>
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

</div>
<div class="center">
    <!-- Button trigger modal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <h5>Gestion des établissements</h5>
            </div>
            <div class="col-4">
                <div class="boxContainer">
                    <table class="elementsContainer">
                        <form action="{{url('/etab/index/search')}}" method="get">
                            <tr>
                                <td>
                                    <input type="text" placeholder="Recherche" class="Search" name="search">
                                </td>
                                <td>
                                   <button class="btn_search" type="submit"><img src="https://img.icons8.com/material-two-tone/24/000000/search.png" /></button>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <!-- Button trigger modal -->
                <a class="btn btn-success" href="{{route('add_etab')}}">Ajouter Établissement</a>
            </div>
        </div>
        <br>
    </div>
    <table class="table col-sm-12" style="border: 1px;">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>E-mail</th>
                <th>Numéro Mobile</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($etabs as $etab)
            <tr>
                <td>{{$etab->id}}</td>
                <td>{{$etab->name}}</td>
                <td>{{$etab->email}}</td>
                <td>{{$etab->phone}}</td>
                <td>{{$etab->adresse}}</td>
                <td>{{$etab->ville}}</td>
                <td>
                    <div class="btn-group">
                        <a href="/Etab/edit/{{$etab->id}}" class="btn btn-success">Modifier</a>
                        <a data-user_id="{{$etab->id}}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$etabs->links()}}
</div>


<!-- -------------------------------------------Start Delete Modal--------------------------------------------------------------- -->
<div class="danger-modal">
    <div class="modal" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <div class="modal-header" id="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer cet établissement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('delete_etab')}}" method="get">
                    @csrf
                    <div class="modal-body" id="modal-body">
                        <input type="hidden" name="id" id="user_id">
                        <div class="align-center">
                            <img src="https://img.icons8.com/fluent/48/000000/general-warning-sign.png" />
                            <p> Voulez-vous supprimer ce Expert</p>
                        </div>
                    </div>
                    <div class="modal-footer" id="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- -------------------------------------------END Delete Modal--------------------------------------------------------------- -->
<script>
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('user_id')
        var modal = $(this)
        modal.find('.modal-title').text('SUPPRIMER DEMANDE');
        modal.find('.modal-body #user_id').val(id);
    })
</script>
@endsection