@extends('layout')

@section('content')
    <div class="card-create">
        <div class="card-header">{{ __('Podatki organizacije') }}</div>
        <div class="card-body">
            <x-form :existingData="$existingData" submitRouteName="organisation_admin.card" backRouteName="organisation_admin.cards"
                submitButtonName="Shrani podatke" backButtonName="Nazaj" :adminInfo="$orgInfo" variableName="cardId">

                <x-input type="text" name="name" displayedName="Ime kartice" placeholder="Vnesite ime kartice"
                    :value="$existingData->name != null ? $existingData->name : ''" />

                <x-input type="text" name="description" displayedName="Opis kartice"
                    placeholder="Vnesite kratek opis kartice" :value="$existingData->description != null ? $existingData->description : ''" />

                <div class="dropdown-group">
                    <label for="organisation">Organizacija</label>
                    <div class="card-join-dropdown">
                        <select class="form-control" name="organisation" id="organisation">
                            @foreach ($orgInfo as $row)
                                @if ($row->id == $existingData->id_organisation)
                                    <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                @else
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <label for="auto_join">Odprt pristop k kartici</label>
                    <div class="card-join-dropdown">
                        <select class="form-control" name="auto_join" id="auto_join">
                            @if ($existingData->auto_join == 'Y')
                                <option value="Y" selected>Da</option>
                                <option value="N">Ne</option>
                            @else
                                <option value="Y">Da</option>
                                <option value="N" selected>Ne</option>
                            @endif
                        </select>
                    </div>

                </div>



            </x-form>
        </div>
    </div>
@endsection
