@extends('layout')

@section('content')
    <div class="profile-card">
        <div class="card-header">{{ __('Urejanje profila') }}</div>

        <div class="card-body">
            <x-form :existingData="$existingData" submitRouteName="sad.profile"
                    backRouteName="sad.profile"
                    submitButtonName="Shrani spremembe" backButtonName="Nazaj">

                <x-input type="text" name="username" displayedName="Uporabniško ime" readonly="true"
                         :value="$existingData->username != null ? $existingData->username : ''"
                         fa-icon="fa-regular fa-user"
                         title="Uporabniško ime"
                />


                <x-input type="text" name="name" displayedName="Ime"
                         :value="$existingData->name != null ? $existingData->name : ''"
                         fa-icon="fa-regular fa-address-card"
                         title="Ime"
                />


                <x-input type="text" name="surname" displayedName="Priimek"
                         :value="$existingData->surname != null ? $existingData->surname : ''"
                         fa-icon="fa-regular fa-address-card"
                         title="Priimek"
                />


                <x-input type="email" name="email" displayedName="E-pošta" readonly="true"
                         :value="$existingData->email != null ? $existingData->email : ''"
                         fa-icon="fa-regular fa-envelope"
                         title="E-poštni naslov"
                />


                <x-input type="number" name="emso" displayedName="EMŠO" readonly="true"
                         :value="$existingData->emso != null ? $existingData->emso : ''"
                         fa-icon="fa-regular fa-address-card"
                         title="EMŠO"
                />

                @php
                    $timestamp = strtotime($existingData->created_at);
                    $formattedDate = date('d.m.Y', $timestamp);
                @endphp
                <x-input type="datetime" name="date" displayedName="Datum članstva" readonly="true"
                         :value="$existingData->created_at != null  ? $formattedDate  : ''"
                         fa-icon="fa-regular fa-clock"
                         title="Datum pridružitve"
                />

            </x-form>
        </div>
    </div>
@endsection
