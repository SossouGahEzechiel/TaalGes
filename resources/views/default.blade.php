<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>TAAL | {{$title = Auth::user()->nom}}_profil </title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <style>
    h1 h2{
      text-align: center;
      margin-bottom: 3mm;
    }
  </style>
  {{-- <script> 
    i = 0
    while(i <=1)
    {
      function secure ()
      {
        locaion.reload(true);
        return stop();
      }
    }
  </script>  --}}

</head>
<body class="fixed-nav bg-primary" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg bg-warning fixed-top" id="mainNav">
    <a class="navbar-brand" href="">{{Auth::user()->nom}} {{Auth::user()->prenom}} </a>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      {{-- Side bar --}}
      <ul class="navbar-nav navbar-sidenav bg-warning" id="exampleAccordion">
        @auth
          {{-- @dd(Auth::user()->fontion) --}}
            @if (Auth::user()->fonction == "admin")
              {{-- Dashboard --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{ route('admin.index') }}">
                  <i class="fa fa-fw fa-dashboard"></i>
                  <span class="nav-link-text">Dashboard</span>
                </a>
              </li>

              {{-- Employés --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu de gestion des employés">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                  <i class="fa fa-fw fa-user-circle-o"></i>
                  <span class="nav-link-text">Gestion des employés</span>
                </a>
                <ul class="sidenav-second-level collapse bg-gradient" id="collapseComponents">
                  <li>
                    <a href="{{route('admin.index') }}">Liste des employés</a>
                  </li>
                  <li>
                    <a href="{{ route('user.create') }}">Nouvel employé</a>
                  </li>
                </ul>
              </li>

              {{-- gestion des demandes --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu de gestion des demandes">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#demande" data-parent="#exampleAccordion">
                  <i class="fa fa-fw fa-list-alt"></i>
                  <span class="nav-link-text">Gestion des demandes</span>
                </a>
                <ul class="sidenav-second-level collapse bg-gradient" id="demande">
                  <li>
                    <a href="{{ route('demande.index') }}">Liste des demandes</a>
                  </li>
                  <li>
                    <a href="{{ route('demande.attente') }}">Liste des demandes en attente</a>
                  </li>
                  <li>
                    <a href="{{ route('demande.refuse') }}">Liste des demandes refusées</a>
                  </li><li>
                    <a href="{{ route('demande.accorde') }}">Liste des demandes acceptées</a>
                  </li>                  
                </ul>
              </li>

              {{-- gestion des Services --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#service" data-parent="#exampleAccordion">
                  <i class="fa fa-fw fa-server"></i>
                  <span class="nav-link-text">Gestion des Services</span>
                </a>
                <ul class="sidenav-second-level collapse bg-gradient" id="service">
                  <li>
                    <a href="{{ route('service.index') }}">Tout les services</a>
                  </li>
                  <li>
                    <a href="{{ route('service.create') }}">Nouveau service</a>
                  </li>
                </ul>
              </li>

              {{-- Statistiques --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Qui était là, et qui n'était pas là ??">
                <a class="nav-link" href="#">
                  <i class="fa fa-fw fa-link"></i>
                  <span class="nav-link-text">Statistiques</span>
                </a>
              </li>

            {{-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
              <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-sitemap"></i>
                <span class="nav-link-text">Menu Levels</span>
              </a>
              <ul class="sidenav-second-level collapse" id="collapseMulti">
                <li>
                  <a href="#">Second Level Item</a>
                </li>
                <li>
                  <a href="#">Second Level Item</a>
                </li>
                <li>
                  <a href="#">Second Level Item</a>
                </li>
                <li>
                  <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
                  <ul class="sidenav-third-level collapse" id="collapseMulti2">
                    <li>
                      <a href="#">Third Level Item</a>
                    </li>
                    <li>
                      <a href="#">Third Level Item</a>
                    </li>
                    <li>
                      <a href="#">Third Level Item</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li> --}}
            
            @else
              {{-- Profil --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mon profil">
                <a class="nav-link" href="{{ route('user.show',Auth::user()->id) }}">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span class="nav-link-text">Mon profil</span>
                </a>
              </li>
              
              {{-- Demandes --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mes demandes">
                <a class="nav-link" href="{{ route('user.profil') }}">
                  <i class="fa fa-list-ul" aria-hidden="true"></i>
                  <span class="nav-link-text">Mes demandes</span>
                </a>
              </li>
              
              {{-- Nouvelle demande --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Nouvelle demande">
                <a class="nav-link" href="{{ route('demande.create') }}">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                  <span class="nav-link-text">Faire une demande</span>
                </a>
              </li>
              @endif
        @endauth
              
      </ul>
      {{-- Navbar --}}
      {{-- Mails --}}
      <ul class="navbar-nav ml-auto">
        {{-- Notification des administrateurs  --}}
        @if (Auth::user()->fonction === "admin" and Auth::user()->unreadNotifications->count()>0)
          {{-- Sonnette --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-bell-o fa-lg" aria-hidden="true"></i>
              <span class="translate-middle badge bg-primary">{{Auth::user()->unreadNotifications->count()}}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="alertsDropdown">
              @if (Auth::user()->unreadNotifications->count() == 1)
                <h6 class="dropdown-header">Une nouvelle notification</h6>
              @else
                <h6 class="dropdown-header">{{Auth::user()->unreadNotifications->count() }} Nouvelles notifications</h6>
              @endif
              <div class="dropdown-divider"></div>
              @forelse (Auth::user()->unreadNotifications as $notification)
              <a class="dropdown-item" href="{{ route('demande.read',[$notification->id,$notification->data["id"]]) }}" >
                <span class="text-success"> 
                <strong>Mail de {{$notification->data['nom']}}</strong>
                </span>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">{{Str::limit($notification->data['objet'])}}</div>
              </a>
              <div class="dropdown-divider"></div>
              @empty
              <a class="dropdown-item small text-warning" href="#">Aucune nouvelle notification</a>
              @endforelse
              @if (Auth::user()->unreadNotifications->count()> 1) 
                <a class="dropdown-item small" href="#">View all alerts</a>
              @endif
            </div>
          </li>
        @endif
        
        {{-- Notification des salariées --}}
        @if (Auth::user()->fonction === "user" and Auth::user()->unreadNotifications->count()>0 )
          {{-- Sonnette --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-bell-o fa-lg" aria-hidden="true"></i>
              <span class="translate-middle badge bg-primary">{{Auth::user()->unreadNotifications->count()}}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="alertsDropdown">
              @if (Auth::user()->unreadNotifications->count() == 1)
                <h6 class="dropdown-header">Une nouvelle notification</h6>
              @else
                <h6 class="dropdown-header">{{Auth::user()->unreadNotifications->count() }} Nouvelles notifications</h6>
              @endif
              <div class="dropdown-divider"></div>
              @forelse (Auth::user()->unreadNotifications as $notification)
                <a class="dropdown-item" href="{{ route('demande.show',$notification->data["id"]) }}">
                  <span class="text-success"> 
                  <strong>Mail de taalcorp@gmail.com</strong>
                  </span>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">Votre demande envoyée le {{$notification->data['date']}}</div>
                </a>
                <div class="dropdown-divider"></div>
              @empty
                <a class="dropdown-item small text-warning" href="#">Aucune nouvelle notification</a>
              @endforelse
              @if (Auth::user()->unreadNotifications->count()> 1) 
                <a class="dropdown-item small" href="#">View all alerts</a>
              @endif
            </div>
          </li>
        @endif
        @if (Route::is('user.index') or Route::is('user.search'))
          <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2" action="{{ route('user.search') }}">
              <div class="input-group">
                <input class="form-control" type="text" name="search" placeholder="Rechercher un salarié" value="{{request()->search ?? ''}}" autofocus>
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </form>
          </li>
        @endif        
        @if (Route::is('demande.index') or Route::is('demande.search') or Route::is('demande.attente') or Route::is('demande.refuse') or Route::is('demande.accorde') )
          <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2" action="{{ route('demande.search') }}">
              <div class="input-group">
                <input class="form-control" type="text" name="search" placeholder="Rechercher un salarié" value="{{request()->search ?? ''}}" autofocus>
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </form>
          </li>
        @endif
  
        @if (Route::is('service.index') or Route::is('service.search'))
          <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2" action="{{ route('service.search') }}">
              <div class="input-group">
                <input class="form-control" type="text" name="search" placeholder="Rechercher un service" value="{{request()->search ?? ''}}" autofocus>
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </form>
          </li>
        @endif

        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">
            <i class="fa fa-fw fa-sign-out"></i>Se déconnecter</a>
        </li>
      </ul>
    </div>
  </nav>
  <!--  Body-->
  <div class="content-wrapper">
    <div class="mt-2 ml-5 mr-5">
      @yield('content')
      <script src="//code.jquery.com/jquery.js"></script>
      @include('flashy::message')
      <br>
    </div>
    <footer class="sticky-footer">
      <div class="container fixed h-10">
        <div class="text-center">
          <small class="btn btn-link">Plateforme de gestion administrative du personnel de la TAAL</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    {{-- <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script> --}}
    <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    {{-- <script src="{{asset('js/sb-admin.min.js')}}"></script> --}}
    <!-- Custom scripts for this page-->
    <script src="{{asset('js/sb-admin-datatables.min.js')}}"></script>
    {{-- <script src="{{asset('js/sb-admin-charts.min.js')}}"></script> --}}
    <script>

    </script>
  </div>
</body>

</html>
