@extends('layout')

@section('content')
    <div class="card-create">
        <div class="card-header">{{ __('Podatki organizacije') }}</div>
        <div class="card-body">
            <x-form :existingData="$existingData" submitRouteName="sad.organisation" backRouteName="sad.organisations"
                submitButtonName="Shrani podatke" backButtonName="Nazaj" :adminInfo="$adminInfo" variableName="organisationId">

                <x-input type="text" name="name" displayedName="Ime organizacije" placeholder="Vnesite ime organizacije"
                    :value="$existingData?->name != null ? $existingData->name : ''" />

                <x-input type="text" name="description" displayedName="Opis organizacije"
                    placeholder="Vnesite kratek opis organizacije" :value="$existingData->description != null ? $existingData->description : ''" />

                <label for="admin">Administrator organizacije</label>

                <div class="card-join-dropdown">
                    <select class="form-control" name="admin" id="admin">
                        <option disabled>Administrator organizacije</option>
                        @foreach ($adminInfo as $row)
                            @if ($row->id == $existingData->id_user)
                                <option value="{{ $row->id }}" selected>{{ $row->username }}</option>
                            @else
                                <option value="{{ $row->id }}">{{ $row->username }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <label for="verified">Preverjena organizacija</label>
                <div class="card-join-dropdown">
                    <select class="form-control" name="verified" id="verified">
                        @if ($existingData->verified == 'Y')
                            <option value="Y" selected>Da</option>
                            <option value="N">Ne</option>
                        @else
                            <option value="Y">Da</option>
                            <option value="N" selected>Ne</option>
                        @endif
                    </select>
                </div>
            </x-form>
        </div>
    </div>
@endsection
