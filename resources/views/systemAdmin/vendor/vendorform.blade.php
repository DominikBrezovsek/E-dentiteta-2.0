@extends('layout')

@section('content')
    <div class="card-create">
        <div class="card-header">{{ __('Dodaj partnerja') }}</div>
        <div class="card-body">
            <x-form :existingData="$existingData" submitRouteName="sad.add-vendor" backRouteName="sad.vendors"
                submitButtonName="Shrani podatke" backButtonName="Nazaj" :adminInfo="$adminInfo">

                <x-input type="text" name="name" displayedName="Ime partnerja"
                    placeholder="Vnesite ime partnerja"/>

                <x-input type="text" name="address_line_1" displayedName="Naslov"
                    placeholder="Vnesite naslov"/>

                <x-input type="number" name="address_line_2" displayedName="Hišna številka" 
                    placeholder="Vnesite hišno številko"/>

                <x-input type="number" name="postal_code" displayedName="Poštna številka"
                    placeholder="Vnesite poštno številko"/>

                <x-input type="text" name="city" displayedName="Mesto"
                    placeholder="Vnesite mesto"/>

                <x-input type="text" name="country" displayedName="Država"
                    placeholder="Vnesite državo"/>


                <label for="admin">Partner</label>
                <div class="card-join-dropdown">
                    <select class="form-control" name="admin" id="admin">
                        @foreach ($adminInfo as $row)
                            <option value="{{ $row?->id }}">{{ $row?->username }}</option>
                        @endforeach
                    </select>
                </div>
            </x-form>
        </div>
    </div>
@endsection
