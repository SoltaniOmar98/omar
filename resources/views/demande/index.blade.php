@extends('admin.dashboard')
@section('title')
List Demande
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
    <h2>Liste des demandes</h2>
    <br>
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
            @foreach($demandes as $demande)
            <tr>
                <td>{{$demande->id}}</td>
                <td>{{$demande->name}}</td>
                <td>{{$demande->email}}</td>
                <td>{{$demande->phone}}</td>
                <td>{{$demande->adresse}}</td>
                <td>{{$demande->ville}}</td>
                <td>

                    <a href="/demande/accept/{{$demande->id}}" class="btn btn-success">Accepter</a>
                    <a data-user_id="{{$demande->id}}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Refuser</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- -------------------------------------------Start Delete Modal--------------------------------------------------------------- -->
<div class="danger-modal">
    <div class="modal" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <div class="modal-header" id="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer Expert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('delete_demande')}}" method="get">
                    @csrf
                        <div class="modal-body" id="modal-body">
                        <input type="hidden" name="id" id="user_id">
                        <p>Voulez-vous supprimer ce demande</p>
                        </div>
                    <div class="modal-footer" id="modal-footer"> 
                        <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type ="submit" class="btn btn-danger">Confirmer</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('user_id')
        var modal = $(this)
        modal.find('.modal-title').text('SUPPRIMER EXPERT');
        modal.find('.modal-body #user_id').val(id);
    })
</script>
@endsection