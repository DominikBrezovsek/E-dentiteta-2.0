@extends('layout')

@section('content')
    <div class="card-create">
        <div class="card-header">{{ __('Ustvari organizacijo') }}</div>
        <div class="card-body">
            <x-form :existingData="$existingData" submitRouteName="sad.add-organisation" backRouteName="sad.organisations"
                submitButtonName="Shrani podatke" backButtonName="Nazaj" :adminInfo="$adminInfo">

                <x-input type="text" name="name" displayedName="Ime organizacije"
                    placeholder="Vnesite ime organizacije" />

                <x-input type="text" name="description" displayedName="Opis organizacije"
                    placeholder="Vnesite kratek opis organizacije" />


                <label for="admin">Administrator organizacije</label>
                <div class="card-join-dropdown">
                    <select class="form-control" name="admin" id="admin">
                        @foreach ($adminInfo as $row)
                            <option value="{{ $row?->id }}">{{ $row?->username }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="verified">Preverjena organizacija</label>
                <div class="card-join-dropdown">
                    <select class="form-control" name="verified" id="verified">
                        <option value="Y">Da</option>
                        <option value="N">Ne</option>
                    </select>
                </div>

                <label for="preverjanje">Preverjanje vseh kartic</label>
                <div class="card-join-dropdown">
                    <select class="form-control" name="preverjanje" id="preverjanje">
                        <option value="Y">Da</option>
                        <option value="N">Ne</option>
                    </select>
                </div>
            </x-form>
        </div>
    </div>
@endsection
