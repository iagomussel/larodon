<html>
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title') - {{config('app.name')}}</title>
  <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
 
  @yield("styles");
  <style>
  .overlay-all{
      display:block;
      opacity: 1;
      position:fixed;
      bottom:0;
      right: 0;
      width: 100%;
      height: 100%;
      background-color: white;
      transition-duration: 0.5s;
      z-index: 10000;
      overflow: hidden;
      text-align: center;
  }
  .overlay-all h3{
        margin-top: 50px;
  }
  .overlay-all.hidden{
    Height:0;
  }
  </style>
</head>
<body >
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('home')}}">{{config('app.name')}}</a>
        <div class="w-100 text-center text-light" ><h2>@yield('title')</h2></div>
        <ul class="navbar-nav px-3">
        <li><a href="{{route('logout')}}"><i class="fa fa-fw fa-power-off"></i> Sair</a></li>
        </ul>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link"  href="{{route('home')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{route('pacientes.index')}}"><i class="fas fa-procedures"></i> Pacientes</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{route('dentistas.index')}}"><i class="fas fa-user-md"></i> Dentistas</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{route('convenios.index')}}"><i class="far fa-handshake"></i> Convenios</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{route('procedimentos.index')}}"><i class="fas fa-tooth"></i> Procedimentos</a>
                                
                            </li>
                                <li class="nav-item">
                                <a  class="nav-link" href="{{route('consultas.index')}}"><i class="fas fa-calendar-alt"></i> Agenda</a>
                                    
                                </li>
                    </ul>
                </div>
            </nav>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div id="app" class="">
            @yield('content')
        </div>
    </main>
        </div>
    </div>
    <div class="overlay-all">
       <h3>Aguarde por favor..</h3> 
    </div>
</body>

<script src="{{asset('assets/js/app.js')}}"></script>
@yield("scripts");
 <script>
 $(document).ready(function(){
     $(".overlay-all").addClass("hidden");
 }

 )
 </script>      
</html>