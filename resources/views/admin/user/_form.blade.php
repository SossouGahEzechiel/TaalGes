@csrf
<div class="row">
    <!-- Nom -->
    <div class="col-6 mb-3">
        <div class="form-floating ">
            <input type="text" class="form-control @error('nom') is-invalid @enderror " id="nom" name="nom" placeholder="nom" value="{{old('nom') ?? $user->nom}}" required autofocus>
            <label for="nom">Nom</label>
        </div>
        @error('nom')
            <div class="text-danger text-center">{{ $message }}</div>
        @enderror
    </div>

    <!-- Prénom -->
    <div class="col-6 mb-3">
        <div class="form-floating ">
            <input type="text" class="form-control @error('prenom') is-invalid @enderror " id="prenom" name="prenom" placeholder="prenom" value="{{old('prenom') ?? $user->prenom }}" required autofocus>
            <label for="prenom">Prénom</label>
        </div>
        @error('prenom')
            <div class="text-danger text-center">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Sexe --><!-- Civilité -->
<div class="row">
    <!-- Sexe -->
    <div class="col-6 mb-3">
        <div class="form-floating">
            <select class="form-select @error('sexe') is-invalid @enderror" id="sexe" name="sexe" aria-label="Floating label select example">
                <option value="F">Féminin</option>
                <option value="M">Masculin</option>
            </select>
            <label for="sexe">Sexe</label>
        </div>
    </div>
    @error('sexe')
        <div class="text-danger text-center">{{ $message }}</div>
    @enderror
    
    <div class="col-6 mb-3mb-">
        <!-- Adresse -->
        <div class="form-floating ">
            <input type="text" class="form-control @error('adresse') is-invalid @enderror " id="adresse" name="adresse" placeholder="adresse" value="{{old('adresse') ?? $user->adresse }}" required autofocus>
            <label for="adresse">Adresse</label>
        </div>
        @error('adresse')
            <div class="text-danger text-center">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">    
    <div class="col-6 mb-3">
        <!-- Email Address -->
        <div class="form-floating ">    
            <input type="text" class="form-control @error('email') is-invalid @enderror " id="email" name="email" placeholder="email" value="{{old('email') ?? $user->email }}" required autofocus>
            <label for="email">Email</label>
        </div>
        @error('email')
            <div class="text-danger text-center">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 mb-3 ">
        <!-- Telephone -->
        <div class="form-floating input-group">
            <span class="input-group-text" id="inputGroupPrepend3">+228</span>
            <input type="tel" class="form-control @error('tel') is-invalid @enderror " id="tel" name="tel" placeholder="tel" value="{{old('tel')?? $user->tel }} " required autofocus>
        </div>
        @error('tel')
            <div class="text-danger text-center">{{ $message }}</div>
        @enderror
    </div>
</div>

@if (Auth::user()->fonction === "admin")
    <div class="row">
        <div class="col-6 mb-3">
            <!-- Date d'embauche -->
            <div class="form-floating ">
                <input type="date" class="form-control @error('dateEmb') is-invalid @enderror " id="dateEmb" name="dateEmb" placeholder="dateEmb" value="{{old('dateEmb') ?? $user->dateEmb}}" required autofocus>
                <label for="dateEmb">{{$user->dateEmb ? $user->dateEmb->format('d/m/y') : 'Date d\'embauche'}}</label>
            </div>
            @error('dateEmb')
                <div class="text-danger text-center">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-3">
            <!-- Nature du contrat -->
            <div class="form-floating">
                <select class="form-select @error('natContat') is-invalid @enderror " id="natCont" name="natCont" aria-label="Floating label select example">
                    <option value="CDD">CDD</option>
                    <option value="CDI">CDI</option>
                </select>
                <label for="natCont">Nature du contrat</label>
                @error('natCont')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-3 mb-3">
            <div class="form-floating ">    
                <input type="number" class="form-control @error('dureCont') is-invalid @enderror " id="dureCont" name="dureCont" placeholder="dureCont" value="{{old('dureCont') ?? $user->dureCont }}" autofocus>
                <label for="dureCont">Durée (en mois)</label>
            </div>
            @error('dureCont')
                <h6 class="text-danger text-center">La durée du contrat est obligatoire s'il s'agit d'un CDD</h6>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-6 mb-3">
            <!-- Fonction -->
            <div class="form-floating">
                <select class="form-select @error('fonction') is-invalid @enderror " id="fonction" name="fonction" aria-label="Floating label select example">
                    <option value="user">Simple utilisateur</option>
                    <option value="admin">Administrateur</option>
                </select>
                <label for="fonction">Fonction</label>
            </div>
            @error('fonction')
                <div class="text-danger text-center">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-6 mb-3">
            <!-- Service -->
            <div class="form-floating">
                <select class="form-select @error('service') is-invalid @enderror " id="service" name="service" aria-label="Floating label select example">
                    @forelse ($services as $service)
                        <option value="{{$service->id}}">{{$service->lib}}</option>
                    @empty
                        <p class="text-danger text-center">Pas de service dans la base de données. Vous devez en ajouter d'abord!!</p>
                    @endforelse
                </select>
                <label for="service">Service</label>
            </div>
            @error('service')
                <div class="text-danger text-center">{{ $message }}</div>
            @enderror
        </div>
    </div>
@endif