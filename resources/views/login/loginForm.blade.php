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
                        />

                    </div>
                    <div>
                        <x-input
                            type="password"
                            name="password"
                            displayed-name="Geslo"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script>

        let registerButton = document.querySelector(".btn-register");

        let animation = gsap.to(".btn-register", {
            paused: true,
            background: "var(--gradient-primary)",
        })

        registerButton.addEventListener("mouseover",() => animation.play())
        registerButton.addEventListener("mouseleave",() => animation.reverse())
    </script>

@endsection
