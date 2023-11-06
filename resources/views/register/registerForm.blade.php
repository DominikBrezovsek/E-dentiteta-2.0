@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Long Form') }}</div>

                    <div class="card-body">
                        <x-form 
                        :existingData="$existingData" 
                        submitRouteName="register" 
                        backRouteName="home"
                        submitButtonName="Registriraj se" 
                        backButtonName="Domov">

                            <x-input 
                            name="name" 
                            displayedName="Ime" 
                            type="text" ></x-input>

                            <x-input 
                            name="surname" 
                            displayedName="Priimek" 
                            type="text" ></x-input>

                            <x-input 
                            name="username" 
                            displayedName="Uporabniško ime" 
                            type="text" ></x-input>

                            <x-input 
                            name="email" 
                            displayedName="E-pošta" 
                            type="email" ></x-input>

                            <x-input 
                            name="emso" 
                            displayedName="EMŠO" 
                            type="text" ></x-input>

                            <x-input 
                            name="password" 
                            displayedName="Geslo" 
                            type="password"></x-input>

                            <x-input 
                            name="password2" 
                            displayedName="Potrdi geslo" 
                            type="password" ></x-input>

                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
