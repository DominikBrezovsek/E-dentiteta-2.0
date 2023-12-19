
@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <x-form
                        :existingData="$existingData" 
                        submitRouteName="admin.profile" 
                        backRouteName="admin.profile"
                        submitButtonName="Posodobi podatke"
                        backButtonName="Nazaj">

                            <x-input 
                            type="text" 
                            name="username" 
                            displayedName="Uporabniško ime" 
                            :value="$existingData->username != null?$existingData->username:'Bedak' "/>

                            <x-input 
                            type="text" 
                            name="name" 
                            displayedName="Ime" 
                            :value="$existingData->name != null?$existingData->name:'Bedak' "/>

                            <x-input 
                            type="text" 
                            name="surname" 
                            displayedName="Priimek" 
                            :value="$existingData->surname != null?$existingData->surname:'Bedak' "/>

                            <x-input 
                            type="email" 
                            name="email" 
                            displayedName="E-pošta" 
                            readonly="true"
                            :value="$existingData->email != null?$existingData->email:'Bedak' "/>

                            <x-input 
                            type="text" 
                            name="username" 
                            displayedName="Uporabniško ime" 
                            readonly="true"
                            :value="$existingData->username != null?$existingData->username:'Bedak' "/>

                            <x-input 
                            type="number" 
                            name="emso" 
                            displayedName="EMŠO" 
                            readonly="true"
                            :value="$existingData->emso != null?$existingData->emso:'Bedak' "/>
                           
                            <x-input 
                            type="datetime" 
                            name="date" 
                            displayedName="Datum članstva" 
                            readonly="true"
                            :value="$existingData->created_at != null?$existingData->created_at:'Bedak' "/>

                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
