<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande d'engagement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</head>
<style>
    .register{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    margin-top: 3%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 50%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    border: none;
    border-radius: 2.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 30%;
    padding-left: 15px
    cursor: pointer;
    
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
</style>
<body>
    
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="https://sauve.tn/wp-content/uploads/2020/11/ineas-logo.png" alt=""/>
                <h3>Bienvenue</h3>
                <p>Vous êtes à 30 secondes de faire votre audit!</p>
                <a href="{{route('auth.login')}}"><input type="submit" name=""  value="Se connecter"/></a>
                <br/>  
            </div>
            <div class="col-md-9 register-right">
              
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Envoyer une demande d'engagement</h3>
                            <form action="{{route ('demande.save') }}" method="post">
                                <div class="row register-form">

                                @if(Session::get('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                    @endif
                
                                    @if(Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{Session::get('fail')}}
                                    </div>
                                    @endif
                                    @csrf

                            <div class="">
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Entrez le nom d'établissement" value="{{old('name')}}">
                                        <span class="text-danger">@error('name') {{$message}} @enderror</span>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="Entrez votre adresse email" value="{{old('email')}}">
                                        <span class="text-danger">@error('email') {{$message}} @enderror</span>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="phone" placeholder="Entrer le numéro de l'établissement" value="{{old('phone')}}">
                                        <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="adresse" placeholder="Entrer l'adresse" value="{{old('adresse')}}">
                                        <span class="text-danger">@error('adresse') {{$message}} @enderror</span>
                                    </div>
                                    <br>
                                
                                    <div class="form-group">
                                        <select class="form-control" name="ville" value="{{old('ville')}}">
                                            <option class="hidden"  selected disabled>Ville</option>
                                            <option value="Ariana">Ariana</option>
                                            <option value="Béja">Béja</option>
                                            <option value="Ben arous">Ben arous</option>
                                            <option value="Bizerte">Bizerte</option>
                                            <option value="Gabes">Gabes</option>
                                            <option value="Gafsa">Gafsa</option>
                                            <option value="Jendouba">Jendouba</option>
                                            <option value="Kairouan">Kairouan</option>
                                            <option value="Kasserine">Kasserine</option>
                                            <option value="Kebili">Kebili</option>
                                            <option value="La manouba">La manouba</option>
                                            <option value="Le kef">Le kef</option>
                                            <option value="Mahdia">Mahdia</option>
                                            <option value="Médenine">Médenine</option>
                                            <option value="Mounastir">Mounastir</option>
                                            <option value="Nabeul">Nabeul</option>
                                            <option value="Sfax">Sfax</option>
                                            <option value="Sidi Bouzid">Sidi Bouzid</option>
                                            <option value="Siliana">Siliana</option>
                                            <option value="Sousse">Sousse</option>
                                            <option value="Tataouine">Tataouine</option>
                                            <option value="Tozeur">Tozeur</option>
                                            <option value="Tunis">Tunis</option>
                                            <option value="Zaghouan">Zaghouan</option>
                                            
    
                                        </select>
                                        <span class="text-danger">@error('ville') {{$message}} @enderror</span>
                                    </div>
                                    <br>
                                    <input type="submit" class="btnRegister"  value="Envoyer"/>

                            </div>
                            
                            

                            </div>

                            </form>
                    </div>
                    
                </div>
                
            </div>
        </div>

    </div>	
</body>

</html>