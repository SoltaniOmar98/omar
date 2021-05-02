<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="center">
        <div class="row" style="margin-top: 45px;">
            <div class="col-md-4 col-md-4">
                <h4>Valider Mon compte</h4>
                <form action="{{ route('modifiermotdepasse')}}" method="get">
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
                    @csrf
                    <input type="hidden" name="id" value="{{$LoggedUser['id']}}">
                    <div class="form-group">
                        <label>Entrer nouveau mot de passe</label>
                        <input type="password" class="form-control" name="NV_password" placeholder="Entrez nouveau mot de passe" value="{{old('NV_password')}}">
                        <span class="text text-danger">@error('NV_password'){{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label>Confirmer mot de passe</label>
                        <input type="password" class="form-control" name="Conf_password" placeholder="Confirmez votre mot de passe" value="{{old('Conf_password')}}">
                        <span class="text text-danger">@error('Conf_password'){{$message}} @enderror</span>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-block btn-primary">Valider</button>
                </form>
                <a href="{{route('auth.login')}}">Se Connecter</a>
            </div>
        </div>
        </div>
    </div>
</body>

</html>