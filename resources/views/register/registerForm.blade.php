@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registriraj se') }}</div>

                    <div class="card-body">

                        <x-form 
                        :existingData="$existingData" 
                        submitRouteName="register" 
                        backRouteName="home"
                        submitButtonName="Registriraj se" 
                        backButtonName="Domov">

                            <x-input 
                            type="text"
                            name="name" 
                            displayedName="Ime" />

                            <x-input 
                            type="text"
                            name="surname" 
                            displayedName="Priimek" />

                            <x-input 
                            type="text"
                            name="username" 
                            displayedName="Uporabniško ime" />

                            <x-input 
                            type="email"
                            name="email" 
                            displayedName="E-pošta" />

                            <x-input 
                            type="number"
                            name="emso" 
                            displayedName="EMŠO" />

                            <x-input 
                            type="password"
                            name="password" 
                            displayedName="Geslo" />

                            <x-input 
                            type="password"
                            name="password2" 
                            displayedName="Potrdi geslo" />

                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
