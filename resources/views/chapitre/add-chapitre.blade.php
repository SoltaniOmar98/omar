@extends('admin.dashboard')
@section('title')
    créer grille|ajouter chapitre
@endsection
@section('content')

    <div>
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

    </div>


    <div class="center">
        <table class="table">
            <tr>
                <td>
                    <b>Titre de grille: </b>{{ $grille->titre }}
                </td>
                <td>
                    <b>Établissement: </b> {{ $query['name'] }}
                </td>
                <td>
                    <form action="{{ url('/chapitre/search') }}" method="get">
                        <div class="input-group">
                            <input type="hidden" name="id" value="{{ $grille->id }}">
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

        <table class="table table-sm">
            <tbody>
                @foreach ($chapitres as $chapitre)
                    <tr>
                        <td colspan="2" class="table-active">{{ $chapitre->titre }}</td>
                        <td><a href="/domaine/add/{{ $chapitre->id }}"><img
                                    src="https://img.icons8.com/flat-round/24/000000/right--v1.png" /></a></td>
                        <!--Go to add domaine-->
                        <td><a href="/chapitre/edit/{{ $chapitre->id }}"><img
                                    src="https://img.icons8.com/android/24/000000/edit.png" /></a></td>
                        <!--Update chapitre-->
                        <td><a href="" data-chapitre_id="{{ $chapitre->id }}" data-bs-toggle="modal"
                                data-bs-target="#deleteModal"><img
                                    src="https://img.icons8.com/plasticine/24/000000/filled-trash.png" /></a></td>
                        <!--Delete chapitre-->
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $chapitres->links() }}
        <div class="col-md-5 col-md-offset-4">
            <form action="{{ route('chapitre_save') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="idgrille" value="{{ $grille->id }}">
                    <label>chapitre</label>
                    <input type="text" class="form-control" name="chapitre" placeholder="Entrez titre de chapitre ">
                    <span class="text-danger">@error('chapitre') {{ $message }} @enderror</span>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
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
@endsection
