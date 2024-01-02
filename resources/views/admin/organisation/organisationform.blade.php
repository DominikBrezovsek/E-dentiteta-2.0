@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Ustvari organizacijo') }}</div>
        <div class="card-body">
            <x-form :existingData="$existingData" submitRouteName="admin.organisation" backRouteName="admin.organisations"
                submitButtonName="Shrani podatke" backButtonName="Nazaj" :adminInfo="$adminInfo">

                <x-input type="text" name="name" displayedName="Ime organizacije" placeholder="Vnesite ime organizacije"/>

                <x-input type="text" name="description" displayedName="Opis organizacije"
                    placeholder="Vnesite kratek opis organizacije"/>


                    <label for="admin">Administrator organizacije</label>
                    <select class="form-control" name="admin" id="admin">
                        @foreach ($adminInfo as $row)
                            <option value="{{ $row?->id }}">{{ $row?->username }}</option>
                        @endforeach
                    </select>

                    <label for="verified">Preverjena organizacija</label>
                    <select class="form-control" name="verified" id="verified">
                        <option value="Y">Da</option>
                        <option value="N">Ne</option>
                    </select>

                    <label for="preverjanje">Preverjanje vseh kartic</label>
                    <select class="form-control" name="preverjanje" id="preverjanje">
                        <option value="Y">Da</option>
                        <option value="N">Ne</option>
                    </select>
            </x-form>
        </div>
    </div>
@endsection
