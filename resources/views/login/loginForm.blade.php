@extends('layout')
{{-- Copilot autogenerated code --}}
@section('content')
    <div class="login-page">
        <div class="login-form">
            <div class="form-title">{{ __('Prijava') }}</div>
            <div class="form-subtitle">Vpiši se v E-dentiteto</div>
            <div class="form-body">
                <x-form
                    :existingData="$existingData"
                    submitRouteName="login"
                    submitButtonName="Prijavi se">
                    <div>
                        <x-input
                            type="text"
                            name="username"
                            displayed-name="Uporabniško ime"
                            fa-icon="fa-regular fa-user"
                        />

                    </div>
                    <div>
                        <x-input
                            type="password"
                            name="password"
                            displayed-name="Geslo"
                            fa-icon="fa-solid fa-lock"
                        />
                    </div>
                </x-form>
            </div>
            <div class=create-account>
                <div>
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <line x1="0" y1="50" x2="200" y2="50"  />
                    </svg>
                </div>
                <div class="text">
                    <p>Ustvari račun</p>
                </div>
                <div>
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <line x1="0" y1="50" x2="200" y2="50" />
                    </svg>
                </div>
            </div>
            <div class="register">
                <a href="{{route('register')}}">
                    <div class="btn-register">
                        Registracija
                    </div>
                </a>
            </div>
            <div class="pwd-reset">
                <a href="{{route('password-reset')}}">
                    <div class="btn-pwd-reset">
                        Pozabljeno geslo?
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
    </div>
    <script src="https://kit.fontawesome.com/f618edc45d.js" crossorigin="anonymous"></script>
@endsection
