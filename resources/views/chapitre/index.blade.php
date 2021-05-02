@extends('admin.dashboard')
@section('title')
    List grille
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
            @if ($chapitre->count() == 0)
                <div class="alert alert-warning">
                    <img src="https://img.icons8.com/color/100/000000/general-warning-sign.png"/>
                    Aucun Chapitre Trouvé dans cette grille
                </div>
            @else
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <h2>List des chapitres </h2>
                    </div>
                    <div class="col-4">
                        <form action="/chapitre/read" method="get">
                            <input type="hidden" name="id" value=" {{$grille->id}} ">
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="Recherche" placeholder="recherche"
                                    name="search">
                                <span class="input-group-text"><button class="btn_search" type="submit"><img
                                            src="https://img.icons8.com/material-two-tone/24/000000/search.png" /></button></span>
                            </div>
                        </form>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                        <a href="/grille/save/{{$grille->id}}" class="btn btn-light">créer chpitre</a>
                    </div>
                </div>
            </div> 
             <div class="container">
                    <table class="table">
                        <thead>
                            <th class="col-9">Chapitre</th>
                            <th class="col-3">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($chapitre as $item)
                                <tr>
                                    <td class="col-9">{{$item->titre}}</td>
                                    <td class="col-3">
                                        <div class="btn-group">
                                            <a href="/domaine/index/{{$item->id}}" class="btn btn-primary">Domaine</a>
                                            <a href="/chapitre/edit/{{$item->id}}" class="btn btn-warning">Modifier</a>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-chapitre_id="{{ $item->id }}" class="btn btn-danger">Supprimer</a>
                                        </div>
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
                        <h5 class="modal-title" id="exampleModalLabel">Supprimer cette grille</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('chapitre.delete') }}" method="get">
                        @csrf
                        <div class="modal-body" id="modal-body">
                            <input type="hidden" name="id" id="chapitre_id">
                            <div class="align-center">
                                <img src="https://img.icons8.com/fluent/48/000000/general-warning-sign.png" />
                                <p> Voulez-vous supprimer ce chapitre</p>
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
            var id = button.data('chapitre_id')
            var modal = $(this)
            modal.find('.modal-title').text('SUPPRIMER DEMANDE');
            modal.find('.modal-body #chapitre_id').val(id);
        })

    </script>
            @endif
        </div>

@endsection
