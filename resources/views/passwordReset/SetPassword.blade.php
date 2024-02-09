<div>
 @extends('layout')

    @section('content')
        <div class="reset-page">
            <div class="reset-form">
                <div class="form-title">{{ __('Nastavi novo  geslo') }}</div>
                <div class="form-subtitle">Vnesite svoje novo geslo</div>
                <div class="form-body">
                    <x-form
                        :existingData="$existingData"
                        submitRouteName="set-new-password"
                        submitButtonName="Shrani novo geslo">
                        <div>
                            <x-input
                                type="password"
                                name="password"
                                displayed-name="Novo geslo"
                                fa-icon="fa-solid fa-lock"
                            />
                        </div>
                        <div>
                            <x-input
                                type="password"
                                name="password2"
                                displayed-name="Ponovi geslo"
                                fa-icon="fa-solid fa-lock"
                            />
                        </div>
                    </x-form>
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
