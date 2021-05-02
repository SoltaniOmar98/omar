@extends('admin.dashboard')
@section('title')
    créer grille|ajouter chapitre
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
        <table class="table">
            <thead>
                <tr>
                    <td> <b>Établissement :</b> {{ $etab->name }}</td>
                    <td> <b>Grille :</b> {{ $grille->titre }} </td>
                    <td> <a href="/grille/save/{{$grille->id}}"><b>Chapitre :</b> {{ $chapitre->titre }} </a></td>
                    <td> <a href="/domaine/add/ {{$chapitre->id}} "><b>Domaine :</b> {{ $domaine->titre }}</a> </td>
                    <td> <a href="/reference/add/ {{$domaine->id}}"><b>Référence :</b> {{ $reference->titre }} </a></td>
                </tr>
            </thead>
        </table>
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <h5>Les critéres</h5>
                    </td>
                    <td>
                        <form action="{{ url('/critere/search') }}" method="get">

                            <div class="input-group">
                                <input type="hidden" name="id" value="{{ $reference->id }}">
                                <input type="text" class="form-control" aria-label="Recherche" placeholder="recherche"
                                    name="search">
                                <span class="input-group-text"><button class="btn_search" type="submit"><img
                                            src="https://img.icons8.com/material-two-tone/24/000000/search.png" /></button></span>
                            </div>
                        </form>
                    </td>
                </tr>
            </thead>
        </table>
        <table class="table">
            @foreach ($criteres as $i)
                <tr>
                    <td>{{ $i->titre }}</td>
                    <td><a href="/critere/edit/{{ $i->id }}"><img
                                src="https://img.icons8.com/android/24/000000/edit.png" /></a></td>
                    <!--Update Domaine-->
                    <td><a href="" data-critere_id="{{ $i->id }}" data-bs-toggle="modal"
                            data-bs-target="#deleteModal"><img
                                src="https://img.icons8.com/plasticine/24/000000/filled-trash.png" /></a></td>
                    <!--Delete Domaine-->

                </tr>
            @endforeach
        </table>
        {{ $criteres->links() }}
        <div class="col-12">
            <form action="{{ route('critere.save') }}" method="POST">
                @csrf
                <table class="table">
                    <tr>
                        <td><label>Référence</label></td>
                        <td>
                            <div class="col-auto">
                                <input type="hidden" name="id" value="{{ $reference->id }}">
                                <input type="text" class="form-control" name="titre" placeholder="Entrez titre de domaine "
                                    value="{{ old('titre') }}">
                                <span class="text-danger">@error('titre') {{ $message }} @enderror</span>
                            </div>
                        </td>
                        <td>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </td>
                    </tr>
                </table>
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
                        <form action="{{ route('critere.delete') }}" method="get">
                            @csrf
                            <div class="modal-body" id="modal-body">
                                <input type="hidden" name="id" id="critere_id">
                                <div class="align-center">
                                    <img src="https://img.icons8.com/fluent/48/000000/general-warning-sign.png" />
                                    <p> Voulez-vous supprimer ce critére</p>
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
                var id = button.data('critere_id')
                var modal = $(this)
                modal.find('.modal-title').text('SUPPRIMER DEMANDE');
                modal.find('.modal-body #critere_id').val(id);
            })
    
        </script>
@endsection
