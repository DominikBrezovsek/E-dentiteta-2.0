@extends('layout')

@section('content')
    <div class="register-page">
        <div class="register-form">
            <div class="form-title">{{ __('Registriraj se') }}</div>
            <div class="form-subtitle">Ustvari svoj račun</div>
            <div class="form-body">

                <x-form
                    :existingData="$existingData"
                    submitRouteName="register"
                    backRouteName="home"
                    submitButtonName="Registriraj se"
                    backButtonName="Nazaj">

                    <x-input
                        type="text"
                        name="name"
                        displayedName="Ime"
                        fa-icon="fa-solid fa-user-pen"
                    />


                    <x-input
                        type="text"
                        name="surname"
                        displayedName="Priimek"
                        fa-icon="fa-solid fa-user-pen"
                    />


                    <x-input
                        type="text"
                        name="username"
                        displayedName="Uporabniško ime"
                        fa-icon="fa-solid fa-user-plus"/>


                    <x-input
                        type="email"
                        name="email"
                        displayedName="E-pošta"
                        fa-icon="fa-solid fa-envelope"
                    />

                    <x-input
                        type="text"
                        name="emso"
                        pattern="[0-9]*"
                        inputmode="numeric"
                        displayedName="EMŠO"
                        fa-icon="fa-solid fa-address-card"
                    />

                    <x-input
                        type="password"
                        name="password"
                        displayedName="Geslo"
                        fa-icon="fa-solid fa-key"
                    />

                    <x-input
                        type="password"
                        name="password2"
                        displayedName="Potrdi geslo"
                        fa-icon="fa-solid fa-key"
                    />

                </x-form>
            </div>
            <div class=create-account>
                <div>
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <line x1="0" y1="50" x2="200" y2="50"  />
                    </svg>
                </div>
                <div class="text">
                    <p>Registriran uporabnik?</p>
                </div>
                <div>
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <line x1="0" y1="50" x2="200" y2="50" />
                    </svg>
                </div>
            </div>
            <div class="register">
                <a href="{{route('home')}}">
                    <div class="btn-register">
                        Prijava
                    </div>
                </a>
            </div>
        </div>
        <div class="landing-text">
            <div class="card">
                <p>
                    E-dentiteta je inovativna aplikacija, ki uporabnikom omogoča enostavno identifikacijo
                    s karticami šolskih ustanov in možnost validacije le-teh.
                </p>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/f618edc45d.js" crossorigin="anonymous"></script>
        </div>

@endsection
