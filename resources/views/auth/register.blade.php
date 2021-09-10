<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nom" name="nom" placeholder="nom" value="{{old('nom')}}" required autofocus>
            <label for="nom">Nom</label>
        </div>

        <!-- Prénom -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" value="{{old('prenom')}}" required autofocus>
            <label for="prenom">Prénom</label>
        </div>

        <!-- Sexe --><!-- Civilité -->
        <div class="row">
            <!-- Sexe -->
            <div class="col-6">
                <div class="form-floating">
                    <select class="form-select" id="sexe" name="sexe" aria-label="Floating label select example">
                        {{-- <option hidden value=""></option> --}}
                        <option value="M">Masculin</option>
                        <option value="F">Féminin</option>
                    </select>
                    <label for="sexe">Sexe</label>
                </div>
            </div>

            <!-- Civilité -->
            <div class="col-6">
                <div class="form-floating">
                    <select class="form-select" id="civilite" name="civilite" aria-label="Floating label select example">
                        {{-- <option hidden value=""></option> --}}
                        <option value="Monsieur">Monsieur</option>
                        <option value="Madame">Madame</option>
                        <option value="Mademoiselle">Mademoiselle   </option>
                    </select>
                    <label for="civilite">Civilité</label>
                </div>
            </div>
        </div><br>

        <!-- Adresse -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="adresse" value="{{old('adresse')}}" required autofocus>
            <label for="adresse">Adresse</label>
        </div>

        <!-- Email Address -->
        <div class="form-floating mb-3">    
            <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{old('email')}}" required autofocus>
            <label for="email">Email</label>
        </div>

        <!-- Telephone -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="tel" name="tel" placeholder="tel" value="{{old('tel')}}" required autofocus>
            <label for="tel">Téléphone</label>
        </div>
        <!-- Date d'embauche --><!-- Nature du contrat -->
        <div class="row">
            <div class="col-6">
                <!-- Date d'embauche -->
                <div class="form-floating mb-3">
                    <input type="Date" class="form-control" id="dateEmbauche" name="dateEmbauche" placeholder="dateEmbauche" value="{{old('dateEmbauche')}}" required autofocus>
                    <label for="dateEmbauche">Date d'embauche</label>
                </div>
            </div>
            <div class="col-6">
                <!-- Nature du contrat -->
                <div class="form-floating">
                    <select class="form-select" id="natCont" name="natCont" aria-label="Floating label select example">
                        {{-- <option hidden value=""></option> --}}
                        <option value="CDD">CDD</option>
                        <option value="CDI">CDI</option>
                    </select>
                    <label for="natCont">Nature du contrat</label>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-6">
                <!-- Fonction -->
                <div class="form-floating">
                    <select class="form-select" id="fonction" name="fonction" aria-label="Floating label select example">
                        {{-- <option hidden value=""></option> --}}
                        <option value="user">Salarié</option>
                        <option value="admin">Administrateur</option>
                    </select>
                    <label for="fonction">Fonction</label>
                </div>
            </div>
            
            <div class="col-6">
                <!-- Service -->
                <div class="form-floating">
                    <select class="form-select" id="service" name="service" aria-label="Floating label select example">
                        {{-- <option hidden value=""></option> --}}
                        <option value="1">Comptabilité</option>
                        <option value="2">Ressources humaines</option>
                    </select>
                    <label for="service">Service</label>
                </div>
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-label for="password" :value="__('Password')" />

            <x-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-button class="ml-4">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>
    </x-auth-card>
</x-guest-layout>
