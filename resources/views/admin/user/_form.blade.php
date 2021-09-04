@csrf
<div class="row">
    <!-- Nom -->
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('nom') is-invalid @enderror " id="nom" name="nom" placeholder="nom" value="{{$user->nom ??old('nom')}}" required autofocus>
            <label for="nom">Nom</label>
        </div>
        @error('nom')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Prénom -->
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('prenom') is-invalid @enderror " id="prenom" name="prenom" placeholder="prenom" value="{{$user->prenom ?? old('prenom')}}" required autofocus>
            <label for="prenom">Prénom</label>
        </div>
        @error('prenom')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Sexe --><!-- Civilité -->
<div class="row">
    <!-- Sexe -->
    <div class="col-6">
        <div class="form-floating">
            <select class="form-select @error('sexe') is-invalid @enderror" id="sexe" name="sexe" aria-label="Floating label select example">
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>
            <label for="sexe">Sexe</label>
        </div>
    </div>
    @error('sexe')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="col-6">
        <!-- Adresse -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('adresse') is-invalid @enderror " id="adresse" name="adresse" placeholder="adresse" value="{{$user->adresse ?? old('adresse')}}" required autofocus>
            <label for="adresse">Adresse</label>
        </div>
        @error('adresse')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">    
    <div class="col-6">
        <!-- Email Address -->
        <div class="form-floating mb-3">    
            <input type="text" class="form-control @error('email') is-invalid @enderror " id="email" name="email" placeholder="email" value="{{$user->email ?? old('email')}}" required autofocus>
            <label for="email">Email</label>
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6">
        <!-- Telephone -->
        <div class="form-floating mb-3">
            <input type="tel" class="form-control @error('tel') is-invalid @enderror " id="tel" name="tel" placeholder="tel" value="{{$user->tel ?? old('tel')}}" required autofocus>
            <label for="tel">Téléphone</label>
        </div>
        @error('tel')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Date d'embauche --><!-- Nature du contrat -->
<div class="row">
    <div class="col-6">
        <!-- Date d'embauche -->
        <div class="form-floating mb-3">
            <input type="Date" class="form-control @error('dateEmb') is-invalid @enderror " id="dateEmb" name="dateEmb" placeholder="dateEmb" value="{{$user->dateEmb ?? old('dateEmbauche')}}" required autofocus>
            <label for="dateEmb">Date d'embauche</label>
        </div>
        @error('dateEmb')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="col-6">
        <!-- Nature du contrat -->
        <div class="form-floating">
            <select class="form-select @error('natContat') is-invalid @enderror " id="natCont" name="natCont" aria-label="Floating label select example">
                <option value="CDD">CDD</option>
                <option value="CDI">CDI</option>
            </select>
            <label for="natCont">Nature du contrat</label>
        </div>
        @error('natCont')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-6">
        <!-- Fonction -->
        <div class="form-floating">
            <select class="form-select @error('fonction') is-invalid @enderror " id="fonction" name="fonction" aria-label="Floating label select example">
                <option value="user">Simple utilisateur</option>
                <option value="admin">Administrateur</option>
            </select>
            <label for="fonction">Fonction</label>
        </div>
        @error('fonction')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="col-6">
        <!-- Service -->
        <div class="form-floating">
            <select class="form-select @error('service') is-invalid @enderror " id="service" name="service" aria-label="Floating label select example">
                @forelse ($services as $service)
                    <option value="{{$service->id}}">{{$service->lib}}</option>
                @empty
                    <p class="alert alert-danger">Pas de service dans la base de données. Vous devez en ajouter d'abord!!</p>
                @endforelse
            </select>
            <label for="service">Service</label>
        </div>
        @error('service')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div> <br>

<div class="row">
    <!-- Password -->
    <div class="col-6">
        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror " id="password" name="password" placeholder="password" value="{{$user->password ?? old('password')}}" required autofocus>
            <label for="password">Mot de passe</label>
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
   <div class="col-6">
        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror " id="password_confirmation" name="password_confirmation" placeholder="password_confirmation" value="{{old('password_confirmation')}}" required autofocus>
            <label for="password_confirmation">Confirmer le mot de passe</label>
        </div>
        @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
   </div>
</div>
<div class="flex items-center justify-end mt-1">
    <button type="submit" class="btn btn-primary btn-block">{{$nat}}</button>
</div>