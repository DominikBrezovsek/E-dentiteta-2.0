<div>
    @extends('layout')

    @section('content')
        <div class="reset-page">
            <div class="reset-form">
                <div class="form-title">{{ __('Ponastavitev gesla') }}</div>
                <div class="form-subtitle">Vnesite svoje uporabniško ime ali e-poštni naslov</div>
                <div class="form-body">
                    <x-form
                        :existingData="$existingData"
                        submitRouteName="password-reset"
                        submitButtonName="Ponastavi geslo">
                        <div>
                            <x-input
                                type="text"
                                name="username"
                                displayed-name="Uporabniško ime ali e-mail"
                                fa-icon="fa-regular fa-user"
                            />

                        </div>
                    </x-form>
                </div>
                <div class=create-account>
                    <div>
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0" y1="50" x2="200" y2="50"/>
                        </svg>
                    </div>
                    <div class="text">
                        <p>Že imate račun?</p>
                    </div>
                    <div>
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0" y1="50" x2="200" y2="50"/>
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
        </div>
        <script src="https://kit.fontawesome.com/f618edc45d.js" crossorigin="anonymous"></script>
</div>


@endsection
