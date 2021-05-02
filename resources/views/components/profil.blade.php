@extends('admin.dashboard')
@section('title')
Profile
@endsection
@section('content')


<div >
    @if(Session::get('profil_update'))
    <div class="alert alert-success">
        {{Session::get('profil_update')}}
    </div>
    @endif
    @if(Session::get('password_updated'))
    <div class="alert alert-success">
        {{Session::get('password_updated')}}
    </div>
    @endif
    @if(Session::get('fail'))
    <div class="alert alert-danger">
        {{Session::get('fail')}}
    </div>
    @endif

    </div>

<div class="center">


    <h4>Profil</h4>
    <br>
    <table class="table-profil">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{$LoggedUserInfo['name']}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{$LoggedUserInfo['email']}}</td>
            </tr>
            <tr>
                <th>Télephone</th>
                <td>{{$LoggedUserInfo['phone']}}</td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td>{{$LoggedUserInfo['adresse']}}</td>
            </tr>
            <tr>
                <th>Ville</th>
                <td>{{$LoggedUserInfo['ville']}}</td>

            </tr>
        </tbody>
    </table>
    <br>
    <!-- Button trigger modal -->
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UpdateProfilModal" href="{{route('update.profil')}}">
            Modifier Mon Profil
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UpdatePassword">
            Modifier Mot de Passe
        </button>

    </div>
    <!-- -------------------------------- Start Update Profil------------------------------------------------------- -->
    <div class="modal fade" id="UpdateProfilModal" tabindex="-1" aria-labelledby="UpdateProfilModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mettre à jour</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route ('update.profil') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$LoggedUserInfo['id']}}">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" class="form-control" name="name" value="{{$LoggedUserInfo['name']}}">

                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{$LoggedUserInfo['email']}}">

                        </div>
                        <div class="form-group">
                            <label for="phone"> Telephone </label>
                            <input type="text" class="form-control" name="phone" value="{{$LoggedUserInfo['phone']}}">

                        </div>
                        <div class="form-group">
                            <label for="adresse"> Adresse </label>
                            <input type="text" class="form-control" name="adresse" value="{{$LoggedUserInfo['adresse']}}">

                        </div>
                        <div class="form-group">
                            <label for="adresse"> Ville </label>
                            <input type="text" class="form-control" name="ville" value="{{$LoggedUserInfo['ville']}}">

                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregitrer</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- -------------------------------- End Update Profil------------------------------------------------------- -->
    <!-- -------------------------------- Start Update Password------------------------------------------------------- -->
    <div class="modal fade" id="UpdatePassword" tabindex="-1" aria-labelledby="UpdatePassword" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifiez mot de passe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('update.password')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$LoggedUserInfo['id']}}">
                        <div class="form-group">
                            <label>Ancien mot de passe </label>
                            <input type="password" class="form-control" name="anc_password">

                        </div>
                        <div class="form-group">
                            <label>Nouveau mot de passe</label>
                            <input type="password" class="form-control" name="nv_password">

                        </div>
                        <div class="form-group">
                            <label> Confirmez mot de passe </label>
                            <input type="password" class="form-control" name="c_password">
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------- End Update Password------------------------------------------------------- -->
</div>

@endsection