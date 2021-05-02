<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</head>

<body>

    <div class="container-fluid  px-10 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto" style="padding-bottom: 1.5rem">
        <!-- -->
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row"> <img src="https://sauve.tn/wp-content/uploads/2020/11/ineas-logo.png" class="logo"> </div>
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> 
                            <img src="/img/ineas.png" class="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <form action="{{route('auth.check')}}" method="post">

                            @if(Session::get('fail'))
                            <div class="alert alert-danger">
                                {{Session::get('fail')}}
                            </div>
                            @endif
                            @csrf
                        <div class="row px-3">
                             <label class="mb-1">
                                <h6 class="mb-0 text-sm">Adresse Email</h6>
                            </label> 
                            <input class="mb-4" type="text" name="email" placeholder="Entrez votre email" value="{{old('email')}}">
                            <span class="text text-danger">@error('email'){{$message}} @enderror</span>
                         </div>
                        <div class="row px-3">
                             <label class="mb-1">
                                <h6 class="mb-0 text-sm">Mot de passe</h6>
                            </label> 
                            <input type="password" name="password" placeholder="Entrez votre mot de passe" value="{{old('password')}}">
                            <span class="text text-danger">@error('password'){{$message}} @enderror</span>
                         </div>
                        <div class="row px-3 mb-4">
                             <a href="{{ route ('motdepasseoublie')}} " class="ml-auto mb-0 text-sm">Mot de passe oublié?</a>
                        </div>
                        <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Se connecter</button> </div>
                        </form>
                        <div class="row mb-4 px-3"> 
                            <small class="font-weight-bold">Vous n'avez pas de compte? 
                                <a href="{{route('demande.engagement')}}" class="text-danger ">Passer une demande d'engagement</a></small>
                         </div>
                    </div>
                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2021. Tous droits réservés.</small>
                    <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
                </div>
            </div>
        </div>
    </div>
</body>
<style>

    body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-color: #fff;
    background-repeat: no-repeat;
    padding:10px;
    }

    .card0 {
    box-shadow: 0px 4px 8px 0px #757575;
    border-radius: 0px;
}

.card2 {
    margin: 0px 40px
}

.logo {
    width: 200px;
    height: 100px;
    margin-top: 20px;
    margin-left: 35px;
}

.image {
    width: 600px;
    height: 300px
}


.text-sm {
    font-size: 14px !important
}

::placeholder {
    color: #BDBDBD;
    opacity: 1;
    font-weight: 300
}

:-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

::-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

input,
textarea {
    padding: 10px 12px 10px 12px;
    border: 1px solid lightgrey;
    border-radius: 2px;
    margin-bottom: 5px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    color: #2C3E50;
    font-size: 14px;
    letter-spacing: 1px
}

input:focus,
textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #304FFE;
    outline-width: 0
}

button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}

a {
    color: inherit;
    cursor: pointer
}

.btn-blue {
    background-color: #1A237E;
    width: 150px;
    color: #fff;
    border-radius: 2px
}

.btn-blue:hover {
    background-color: #000;
    cursor: pointer
}

.bg-blue {
    color: #fff;
    background-color: #1A237E
}

@media screen and (max-width: 991px) {
    .logo {
        margin-left: 0px
    }

    .image {
        width: 300px;
        height: 220px
    }

    .border-line {
        border-right: none
    }

    .card2 {
        border-top: 1px solid #EEEEEE !important;
        margin: 0px 15px
    }
}
</style>
</html>