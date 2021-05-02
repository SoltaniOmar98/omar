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
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <h2>List des grilles</h2>
                </div>
                <div class="col-4">
                    <form action="/grille/search" method="get">

                        <div class="input-group">
                            <input type="text" class="form-control" aria-label="Recherche" placeholder="recherche"
                                name="search">
                            <span class="input-group-text"><button class="btn_search" type="submit"><img
                                        src="https://img.icons8.com/material-two-tone/24/000000/search.png" /></button></span>
                        </div>
                    </form>
                </div>
                <div class="col-4 d-flex justify-content-end">
                    <a href="{{ route('add_grille') }}" class="btn btn-light">creer grille</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($grilles as $item)
                    <div class="col-md-3">
                        <br>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->titre }}</h5>
                                <p class="card-text">
                                    Établissement : {{ $item->name }}
                                </p>
                                <div class="btn-group">
                                    <a href="/chapitre/index/{{$item->id}}" class="btn btn-primary">Chapitre</a>
                                    <a href="/grille/edit/{{$item->id}}" class="btn btn-warning">Modifier</a>
                                    <a data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-grille_id="{{ $item->id }}" class="btn btn-danger">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
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
                    <form action="{{ route('delete.grille') }}" method="get">
                        @csrf
                        <div class="modal-body" id="modal-body">
                            <input type="hidden" name="id" id="grille_id">
                            <div class="align-center">
                                <img src="https://img.icons8.com/fluent/48/000000/general-warning-sign.png" />
                                <p> Voulez-vous supprimer cette grille</p>
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
            var id = button.data('grille_id')
            var modal = $(this)
            modal.find('.modal-title').text('SUPPRIMER DEMANDE');
            modal.find('.modal-body #grille_id').val(id);
        })

    </script>
@endsection
