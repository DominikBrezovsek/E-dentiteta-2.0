@extends('layout')

@section('content')
    <div class="card-create">
        <div class="card-header">{{ __('Ustvari kartico') }}</div>
        <div class="card-body">
            <x-form :existingData="$existingData" submitRouteName="organisation_admin.card" backRouteName="organisation_admin.cards"
                submitButtonName="Shrani podatke" backButtonName="Nazaj" :orgInfo="$orgInfo" variableName="cardId">

                <x-input type="text" name="name" displayedName="Ime kartice" placeholder="Vnesite ime kartice"/>

                <x-input type="text" name="description" displayedName="Opis kartice"
                    placeholder="Vnesite kratek opis kartice"/>
                <div class="dropdown-group">
                    <label for="organisation">Organizacija</label>
                    <div class="card-join-dropdown">
                        <select name="organisation" id="organisation">
                            @foreach ($orgInfo as $row)
                                <option value="{{ $row?->id }}">{{ $row?->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="auto_join">Odprt pristop k kartici</label>
                    <div class="card-join-dropdown">
                        <select name="auto_join" id="auto_join">
                            <option value="Y">Da</option>
                            <option value="N">Ne</option>
                        </select>
                    </div>
                </div>


            </x-form>
        </div>
    </div>
@endsection
