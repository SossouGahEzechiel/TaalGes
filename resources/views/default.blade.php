<!DOCTYPE html>
<html lang="en">
  {{-- @foreach (Auth::user()->unreadNotifications as $notification){
    @dump($notification)
  }
  @endforeach
  @die() --}}
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <code hidden>
    @switch(url()->current())
      @case(route('user.index'))
        {{$title = "Liste des salariés"}}
        @break
      @case(route('user.create'))
        {{$title = "Ajouter un nouveau salarié"}}
        @break
      @case(route('user.show',[Auth::user()]))
        {{$title = "Mon profil"}}
        @break
      @case(route('user.profil'))
        {{$title = "Mes demandes"}}
        @break
      @case(route('mails'))
        {{$title = "Ma boîte mail"}}
        @break
      @case(route('demande.index'))
        {{$title = "Liste des demandes"}}
        @break
      @case(route('demande.create'))
        {{$title = "Faire une demande"}}
        @break
      @case(route('service.index'))
        {{$title = "Liste des Services"}}
        @break
      @case(route('stat.parService'))
        {{$title = "Page des statistiques par service"}}
        @break
      @case(route('stat.parIntervalle'))
        {{$title = "Page des statistiques par intervalle de temps"}}
        @break
      @case(route('user.index'))
        {{$title = "Liste des salariés"}}
        @break
      @case(route('user.index'))
        {{$title = "Liste des salariés"}}
        @break
    
      @default
        {{$title = "Plateforme de gestion"}}
    @endswitch
  </code>
  <title>TAAL | {{$title}} </title>
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


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" 
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

  <style>
    h1,h2,h6{
      text-align: center;
      margin-bottom: 3mm;
    }
  </style>
  <script>
    function hide(id){
      var target = document.getElementById(id);
      return target.style.display = "none";
    }
    function display(id){
      var target = document.getElementById(id);
      return target.style.display = "block";
    }
    function visibility(id){
      var el = document.getElementById(id);
      if(el.style.display == "block"){
        document.getElementById('but').innerHTML = "Plus";
        return el.style.display = "none";
      }
      else{
        el.colSpan = "4";
        document.getElementById('but').innerHTML = "Moins";
        return el.style.display = "block"; 
      }      
    }
  </script>

</head>
  <body class="fixed-nav bg-light" id="page-top" >
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top" id="mainNav">
      <a class="navbar-brand text-light" href="{{ route('user.show', [Auth::user()]) }}" style="font-style: italic; font-size: 15px">
        @if (Auth::user()->sexe === 'M')
          <img src="{{ asset('images/profilHomme.jpg') }}" alt="{{Auth::user()->nom}}" sizes="" srcset="" height="20px" width="20px">
        @else
          <img src="{{ asset('images/profilFemme.jpg') }}" alt="{{Auth::user()->nom}}" sizes="" srcset="" height="20px" width="20px">
        @endif
        {{Auth::user()->nom}} {{Auth::user()->prenom}} 
      </a>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        {{-- Side bar --}}
        <ul class="navbar-nav navbar-sidenav bg-secondary" id="exampleAccordion">
          @auth
            @if (Auth::user()->fonction == "admin")
              {{-- Dashboard --}}
              <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{ route('admin.index') }}">
                  <i class="fa fa-fw fa-dashboard" style="color: white;"></i>
                  <span class="nav-link-text text-light" style="font-style:;">Dashboard</span>
                </a>
              </li>

              {{-- Employés --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu de gestion des employés">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion" style="color: white;">
                  <i class="fa fa-users" aria-hidden="true"></i>
                  <span class="nav-link-text">Gestion des employés</span>
                </a>
                <ul class="sidenav-second-level collapse bg-gradient" id="collapseComponents">
                  <li>
                    <a href="{{route('admin.index') }}" style="color: white">Liste des employés</a>
                  </li>
                  <li>
                    <a href="{{ route('user.create') }}" style="color: white">Nouvel employé</a>
                  </li>
                </ul>
              </li>

              {{-- gestion des demandes --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu de gestion des demandes"> 
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#demande" data-parent="#exampleAccordion" style="color: white;">
                  <i class="fa fa-list" aria-hidden="true"></i>
                  <span class="nav-link-text" >Gestion des demandes</span>
                </a>
                <ul class="sidenav-second-level collapse bg-gradient" id="demande">

                  <li>
                    <a class="nav-link-collapse collapsed " data-toggle="collapse" data-parent="#demande" href="#main" style="color: white"><i class="fa fa-home" aria-hidden="true"></i></i> Menu principal</a>
                    <ul class="sidenav-third-level collapse bg-gradient" id="main" style="color: white">
                      <li>
                        <a href="{{ route('demande.index') }}" style="color: white">Liste des demandes</a>
                      </li>
                      <li>
                        <a href="{{ route('demande.attente') }}" style="color: white">Liste des demandes en attente</a>
                      </li>
                      <li>
                        <a href="{{ route('demande.refuse') }}" style="color: white">Liste des demandes refusées</a>
                      </li><li>
                        <a href="{{ route('demande.accorde') }}" style="color: white">Liste des demandes acceptées</a>
                      </li> 
                    </ul>
                  </li>  
                  <li>
                    <a class="nav-link-collapse collapsed" data-toggle="collapse" data-parent="#demande" href="#plusOption" style="color: white"><i class="fa fa-plus" aria-hidden="true"></i> Plus d'options</a>
                    <ul class="sidenav-third-level collapse bg-gradient" id="plusOption" style="color: white">
                      <li>
                        <a href="{{ route('byTime.today', ['id'=>1]) }}" style="color: white">Demandes soumises aujourd'hui</a>
                      </li>
                      <li>
                        <a href="{{ route('byTime.week', ['id'=>1]) }}" style="color: white">Demandes soumises cette semaine </a>
                      </li>
                      <li>
                        <a href="{{ route('byTime.month', ['id'=>1]) }}" style="color: white">Demandes soumises ce mois</a>
                      </li>
                    </ul>
                  </li>                
                </ul>
              </li>

              {{-- gestion des Services --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu de gestion des services">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#service" data-parent="#exampleAccordion" style="color: white;">
                  <i class="fa fa-fw fa-server"></i>
                  <span class="nav-link-text">Gestion des Services</span>
                </a>
                <ul class="sidenav-second-level collapse bg-gradient" id="service">
                  <li>
                    <a href="{{ route('service.index') }}" style="color: white">Tout les services</a>
                  </li>
                  <li>
                    <a href="{{ route('service.create') }}" style="color: white">Nouveau service</a>
                  </li>
                </ul>
              </li>
              
              {{-- Statistiques --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu des statistiques">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion" style="color: white">
                  <i class="fa fa-line-chart" aria-hidden="true"></i>
                  <span class="nav-link-text">Statistiques</span>
                </a>
                <ul class="sidenav-second-level collapse bg-gradient" id="collapseMulti" style="color: white">
                  <li>
                    <a href="{{ route('stat.parService')}}" style="color: white" title="Par service 🦺">Regroupement des données par service</a>
                  </li>
                  <li>
                    <a href="{{ route('stat.parIntervalle')}}" style="color: white" title="[t1,t2]">Regroupement des données par intervalle de temps</a>
                  </li>
                  {{-- <li>
                    <a href="#" style="color: white">Second Level Item</a>
                  </li>
                  <li>
                    <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2"  style="color: white">Third Level</a>
                    <ul class="sidenav-third-level collapse bg-gradient" id="collapseMulti2">
                      <li>
                        <a href="#" style="color: white">Third Level Item</a>
                      </li>
                      <li>
                        <a href="#" style="color: white">Third Level Item</a>
                      </li>
                      <li>
                        <a href="#" style="color: white">Third Level Item</a>
                      </li>
                    </ul>
                  </li> --}}
                </ul>
              </li>

              {{-- About me --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mon compte">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#self" data-parent="#exampleAccordion" style="color: white;">
                  <i class="fa fa-user-md" aria-hidden="true"></i>
                  <span class="nav-link-text">Mon compte</span>
                </a>
                <ul class="sidenav-second-level collapse bg-gradient" id="self">
                  <li>
                    <a href="{{ route('user.show',Auth::user()->id) }}" style="color: white">Mon compte</a>
                  </li>
                  <li>
                    <a href="{{ route('user.profil') }}" style="color: white">Mes demandes</a>
                  </li>
                  <li>
                    <a href="{{ route('demande.create') }}" style="color: white">Faire une demande</a>
                  </li>
                  {{-- Consulter ses mails --}}
                  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Nouvelle demande">
                    <a class="nav-link" href="{{ route('mails') }}" style="color: white">
                      <i class="fa fa-envelope-o" aria-hidden="true"></i>
                      <span class="nav-link-text">Mes mails</span>
                    </a>
                  </li>
                </ul>
              </li>
          @else
              {{-- Profil --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mon profil">
                <a class="nav-link" href="{{ route('user.show',Auth::user()->id) }}" style="color: white">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span class="nav-link-text">Mon profil</span>
                </a>
              </li>
              
              {{-- Demandes --}}
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mes demandes">
                <a class="nav-link" href="{{ route('user.profil') }}" style="color: white">
                  <i class="fa fa-list-ul" aria-hidden="true"></i>
                  <span class="nav-link-text">Mes demandes</span>
                </a>
              </li>
              
                {{-- Nouvelle demande --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Nouvelle demande">
                  <a class="nav-link" href="{{ route('demande.create') }}" style="color: white">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span class="nav-link-text">Faire une demande</span>
                  </a>
                </li>
                
                {{-- Consulter ses mails --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Nouvelle demande">
                  <a class="nav-link" href="{{ route('mails') }}" style="color: white">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span class="nav-link-text">Mes mails</span>
                  </a>
                </li>
              @endif
              {{-- Game --}}
              <li class="nav-item" data-toggle="tooltip"  data-placement="right" title="À quoi ça sert ?" >
                <div class="ml-3" onclick="visibility('monBody');" id="game" style="display: none">
                  <i class="fa fa-gamepad" aria-hidden="true" style="color: white"></i>
                </div>
              </li>
          @endauth
        </ul>
        {{-- Navbar --}}
        {{-- Mails --}}
        <ul class="navbar-nav ml-auto">
          {{-- Notification des administrateurs  --}}
          @if (Auth::user()->fonction === "admin" and Auth::user()->unreadNotifications->count()>0)
            {{-- Sonnette --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
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
                  @if ($notification->type != "App\Notifications\AvisNotification")
                    <a class="dropdown-item" href="{{ route('demande.read',[$notification->id,$notification->data["id"]]) }}">
                      <span class="text-success"> 
                      <strong>Mail de {{$notification->data['de']}}</strong>
                      </span>
                      <span class="small float-right text-muted">{{$notification->created_at->locale('fr')->calendar()}}</span>
                      <div class="dropdown-message small">{{Str::limit($notification->data['objet'])}}</div>
                    </a>
                  @else
                    <a class="dropdown-item" href="{{ route('flashMails',[$notification->id,$notification->data["demandeId"]]) }}" >
                      <span class="text-success"> 
                      <strong>Mail de TAAL-corp</strong>
                      </span>
                      <span class="small float-right text-muted">{{$notification->created_at->locale('fr')->calendar()}}</span>
                      <div class="dropdown-message small">Mail d'avisement</div>
                    </a>
                  @endif
                  
                  <div class="dropdown-divider"></div>
                @empty
                  <a class="dropdown-item small text-warning" href="#">Aucune nouvelle notification</a>
                @endforelse
                @if (Auth::user()->unreadNotifications->count()> 1) 
                  <a class="dropdown-item small" href="{{ route('toutLire') }}">Tout marquer comme lu</a>
                @endif
              </div>
            </li>
          @endif
          
          {{-- Notification des salariées --}}
          @if (Auth::user()->fonction === "user" and Auth::user()->unreadNotifications->count()>0 )
            {{-- Sonnette --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white">
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
                  @if ($notification->type != "App\Notifications\AvisNotification")
                    <a class="dropdown-item" href="{{ route('demande.read',[$notification,$notification->data["id"]]) }}">
                      <span class="text-success"> 
                      <strong>Mail de taalcorp@gmail.com</strong>
                      </span>
                      <span class="small float-right text-muted">{{$notification->created_at->format('d/m')}} à {{$notification->created_at->format('G:i')}}</span>
                      <div class="dropdown-message small">{{Str::limit("Votre demande envoyée le".$notification->data['date'],22)}}</div>
                    </a>
                    <div class="dropdown-divider"></div>
                  @else
                    <a class="dropdown-item" href="{{ route('flashMails',[$notification->id,$notification->data["demandeId"]]) }}" >
                      <span class="text-success"> 
                      <strong>Mail de TAAL-corp</strong>
                      </span>
                      <span class="small float-right text-muted">{{$notification->created_at->locale('fr')->calendar()}}</span>
                      <div class="dropdown-message small">Mail d'avisement</div>
                    </a>
                    <div class="dropdown-divider"></div>
                  @endif
                  
                @empty
                  <a class="dropdown-item small text-warning" href="#">Aucune nouvelle notification</a>
                @endforelse
                @if (Auth::user()->unreadNotifications->count()> 1) 
                  <a class="dropdown-item small" href="{{ route('toutLire') }}">Tout marquer comme lu</a>
                @endif
              </div>
            </li>
          @endif
          @if (Route::is('user.index') or Route::is('user.search'))
            <li class="nav-item">
              <form class="form-inline my-2 my-lg-0 mr-lg-2" action="{{ route('user.search') }}" style="color: white">
                <div class="input-group">
                  <input class="form-control" type="text" name="search" placeholder="Rechercher un salarié" value="{{request()->search ?? ''}}" autofocus>
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">
                      <i class="fa fa-search" aria-hidden="true"></i>
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
                      <i class="fa fa-search" aria-hidden="true"></i>
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
                      <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                  </span>
                </div>
              </form>
            </li>
          @endif

          <li class="nav-item" onclick="display('logout');">
            <a class="nav-link"  style="color: white;">
              <i class="fa fa-power-off" aria-hidden="true"></i>
            </i>Se déconnecter
            </a>
          </li>
          
        </ul>
      </div>
    </nav>

    <!--  Body-->
    <div class="content-wrapper">
      <div class="mt-0 ml-5 mr-5" id="monBody" style="display: ">
        @yield('content')
        @if (session('status'))
          <div class="alert alert-danger text-center" id="alerte" onclick="return document.getElementById('alerte').style.display = 'none';"  >
              {{ session('status') }}
          </div>
      @endif
        <script src="{{ asset('//code.jquery.com/jquery.js') }}"></script>
        @include('flashy::message')
        <br>
      </div>
    </div>
    
    <div class="sticky-footer bg-secondary" style="margin-left: 66mm; height: 15mm;">
      <div class="text-center mt-2" ondblclick="visibility('game');">
        <small class="btn" style="color: white" title='Bravo tu es au bon endroit quelle est la prochaine étape ?'>Plateforme de gestion administrative du personnel de la TAAL</small>
      </div>
    </div>
      
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-caret-up" aria-hidden="true" style="color: yellow"></i>
      </a>
      {{-- Deconnexion --}}
      <div class="modal fade show" id="logout" tabindex="-1" role="dialog" name="pop" aria-labelledby="exampleModalLabel" style="padding-right: 17px; display:;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body" style="text-align: center;">Voulez-vous vraiment vous déconnecter ?</div>
            <div class="modal-footer">
              <a class="btn btn-primary" onclick="hide('logout');">Annuler</a>
              <p style="padding-right: 45%"></p>
              <a class="btn btn-danger ml-3" href="{{ route('logout') }}">Me déconnecter</a>
            </div>
          </div>
        </div>
      </div>
      
      {{-- Suppression --}}
      @if (url()->current() ==route('user.index'))
        <div class="modal fade show" id="supp" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" style="padding-right: 17px; display:;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body text-danger" style="text-align: center; font-size: 2em">Voulez-vous vraiment vous retirer cet salarié ?</div>
              <p style="padding-right: 45%""></p>
              <div class="modal-footer">
                <a class="btn btn-primary" onclick="return document.getElementById('supp').style.display = 'none';" type="button" data-dismiss="modal" >Annuler</a>
                <form action="{{ route('user.destroy',$user->id) }}" method="POST" class="btn">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endif
      
      {{-- Suppression de service --}}
      @if (url()->current() == route('service.index'))
        <div class="modal fade show" id="serviceDelete" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" style="padding-right: 17px; display:;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body text-danger" style="text-align: center; font-size: 15px">Voulez-vous vraiment vous retirer ce service ? Celà entrainerait la suppresion des salariées qui y sont employés</div>
              <p style="padding-right: 45%""></p>
              <div class="modal-footer">
                <a class="btn btn-primary" onclick="return document.getElementById('serviceDelete').style.display = 'none';" type="button" data-dismiss="modal" >Annuler</a>
                <form action="{{ route('service.destroy',$service->id) }}" method="POST" class="btn">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endif


      
      <!-- Bootstrap core JavaScript-->
      <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
      <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- Core plugin JavaScript-->
      <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
      <!-- Page level plugin JavaScript-->
      <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
      <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
      <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
      <!-- Custom scripts for all pages-->
      <script src="{{asset('js/sb-admin.min.js')}}"></script>
      <!-- Custom scripts for this page-->
      <script src="{{asset('js/sb-admin-datatables.min.js')}}"></script>
      {{-- <script src="{{asset('js/sb-admin-charts.min.js')}}"></script> --}}
    
  </body>

</html>
