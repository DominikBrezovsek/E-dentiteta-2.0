@extends('layout')

@section('content')
    <div class="organisation-header">Upravljanje z organizacijo</div>
    <div class="organisation-data">
        @if(isset($existingData))
        <div class="organisation-logo">
            <img src="{{Storage::url('images/'.$existingData->logo)}}" alt="Organisation logo">
        </div>
            <div class="organisation-info">
                <h5>Podatki organizacije</h5>
                <x-form :existingData="$existingData" submitRouteName="organisation_admin.organisation"
                        backRouteName="organisation_admin.organisation"
                        submitButtonName="Shrani spremembe" backButtonName="Nazaj"
                >

                    <x-input type="text" name="name" displayedName="Ime organizacije"
                             :value="$existingData->name != null ? $existingData->name : ''"
                             fa-icon="fa-regular fa-office"
                             title="Ime organizacije"
                    />


                    <x-input type="text" name="description" displayedName="Opis organizacije"
                             :value="$existingData->description != null ? $existingData->description : ''"
                             fa-icon="fa-regular fa-letter"
                             title="Opis organizacije"
                    />
                    <x-input type="file" name="logo" placeholder="Izberi sliko" displayedName="Logo organizacije"
                             :value="$existingData->logo != null ? $existingData->logo : ''"
                             fa-icon="fa-regular fa-image"
                             title="Logo organizacije"
                    />
                </x-form>

            </div>
        @endif
    </div>
@endsection
