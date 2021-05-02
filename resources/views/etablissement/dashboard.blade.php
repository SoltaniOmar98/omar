<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link rel="stylesheet" href="/css/app.css">
<x-header />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<title>@yield('title')</title>

<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="{{route('Dash.Home')}}">
                    <h2><span class="lab la-accusoft"></span> Ineas</h2>
                </a>
            </li>
            <li>
                <a href="">Dashboard</a>
            </li>
            <li>
                <a href="{{route('auto_eval')}}" >Auto Évaluation</a>
            </li>
            <li>
                <a href="">Établissement</a>
            </li>
            <li>
                <a href="">Demandes</a>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#">Services</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <header id="page-content-wrapper" class="header-shadow">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <a href="#menu-toggle" class="btn-toggle-menu" id="menu-toggle">
                        <h3>
                            <label for="nav-toggle">
                                <span class="las la-bars"></span>
                            </label>

                        </h3>
                    </a>
                </div>
                <div class="col-6 d-flex justify-content-end ">
                    <div class="dropdown">
                        <button class="btn btn-light" type="button" id="DropDownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                           Compte
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="DropDownMenu">

                            <li><a class="dropdown-item" href="{{route('Mon_profil')}}">Mon Profil</a></li>

                            <li><a class="dropdown-item" href="{{ route('auth.logout')}}">Se Déconnecter</a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </header>
    <!-- /#page-content-wrapper -->
    <main >

           <div class="container">
           @yield('content')
           </div>
            
       

    </main>

    <!--  <footer class="footer">
        
           <p> ©2020 - 2021 </p>
           <p></p>
        < Copyright 
    </footer>-->
</div>
<!-- /#wrapper -->

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
