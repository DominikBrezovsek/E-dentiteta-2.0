@extends('layout')

@section('content')
    <div class="card-create">
        <div class="card-header">{{ __('Podatki partnerja') }}</div>
        <div class="card-body">
            <x-form :existingData="$existingData" submitRouteName="sad.vendor" backRouteName="sad.vendors"
                submitButtonName="Shrani podatke" backButtonName="Nazaj" :adminInfo="$adminInfo" variableName="vendorId">

                <x-input type="text" name="name" displayedName="Ime partnerja" placeholder="Vnesite ime partnerja"
                    :value="$existingData?->name != null ? $existingData->name : ''" />

                <x-input type="text" name="address_line_1" displayedName="Naslov" placeholder="Vnesite naslov"
                    :value="$existingData?->address_line_1 != null ? $existingData->address_line_1 : ''" />

                <x-input type="number" name="address_line_2" displayedName="Hišna številka"
                    placeholder="Vnesite hišno številko" :value="$existingData?->address_line_2 != null ? $existingData->address_line_2 : ''" />

                <x-input type="number" name="postal_code" displayedName="Poštna številka"
                    placeholder="Vnesite poštno številko" :value="$existingData?->postal_code != null ? $existingData->postal_code : ''" />

                <x-input type="text" name="city" displayedName="Mesto" placeholder="Vnesite mesto"
                    :value="$existingData?->city != null ? $existingData->city : ''" />

                <x-input type="text" name="country" displayedName="Država" placeholder="Vnesite državo"
                    :value="$existingData?->country != null ? $existingData->country : ''" />


                <label for="admin">Partner</label>
                <div class="card-join-dropdown">
                    <select class="form-control" name="admin" id="admin">
                        @foreach ($adminInfo as $row)
                            @if ($row->id == $existingData->id_user)
                                <option value="{{ $row->id }}" selected>{{ $row->username }}</option>
                            @else
                                <option value="{{ $row->id }}">{{ $row->username }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </x-form>
        </div>
    </div>
@endsection
