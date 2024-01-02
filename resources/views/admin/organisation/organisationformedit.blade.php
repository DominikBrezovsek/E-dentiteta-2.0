@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Podatki organizacije') }}</div>
        <div class="card-body">
            <x-form :existingData="$existingData" submitRouteName="admin.organisation" backRouteName="admin.organisations"
                submitButtonName="Shrani podatke" backButtonName="Nazaj" :adminInfo="$adminInfo" variableName="organisationId">

                <x-input type="text" name="name" displayedName="Ime organizacije" placeholder="Vnesite ime organizacije"
                    :value="$existingData?->name != null ? $existingData->name : ''" />

                <x-input type="text" name="description" displayedName="Opis organizacije"
                    placeholder="Vnesite kratek opis organizacije" :value="$existingData->description != null ? $existingData->description : ''" />

                    <label for="admin">Administrator organizacije</label>

                    <select class="form-control" name="admin" id="admin">
                        @foreach ($adminInfo as $row)
                            @if ($row->id == $existingData->id_user)
                                <option value="{{ $row->id }}" selected>{{ $row->username }}</option>
                            @else
                                <option value="{{ $row->id}}">{{ $row->username }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="verified">Preverjena organizacija</label>

                    <select class="form-control" name="verified" id="verified">
                        @if ($row->verified == 'Y')
                            <option value="Y" selected>Da</option>
                            <option value="N">Ne</option>
                        @else
                            <option value="Y">Da</option>
                            <option value="N" selected>Ne</option>
                        @endif
                    </select>
                    <label for="preverjanje">Preverjanje vseh kartic</label>
                    <select class="form-control" name="preverjanje" id="preverjanje">
                        @if ($row->checkking_all_cards == 'Y')
                            <option value="Y" selected>Da</option>
                            <option value="N">Ne</option>
                        @else
                            <option value="Y">Da</option>
                            <option value="N" selected>Ne</option>
                        @endif
                    </select>
            </x-form>
        </div>
    </div>
@endsection
