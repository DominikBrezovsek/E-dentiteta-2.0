@extends('layout')

@section('content')
    <div class="create-student">
        <div class="card-header">{{ __('Podatki o uporabniku') }}</div>
        <div class="card-body">
            <x-form submitRouteName="organisation_admin.student" backRouteName="organisation_admin.students"
                    submitButtonName="Shrani uporabnika" backButtonName="Nazaj" :cardInfo="$cardInfo"
                    variableName="userId" :roles="$roles" :existingData="$existingData">
                <div class="text-inputs">
                    <x-input type="text" name="name" displayedName="Ime" placeholder="Vnesite ime"
                             fa-icon="fa-solid fa-user"
                             :value="$existingDataa[0]->name ?? ''"/>


                    <x-input type="text" name="surname" displayedName="Priimek" placeholder="Vnesite priimek"
                             fa-icon="fa-solid fa-user"
                             :value="$existingDataa[0]->surname ?? ''"/>

                    <x-input type="email" name="email" displayedName="E-pošta" placeholder="Vnesite e-pošto"
                             fa-icon="fa-solid fa-envelope"
                             :value="$existingDataa[0]->email ?? ''"/>

                    <x-input type="text" name="username" displayedName="Uporabniško ime"
                             fa-icon="fa-solid fa-user"
                             placeholder="Vnesite uporabniško ime"
                             :value="$existingDataa[0]->username ?? ''"/>

                    <x-input type="text" name="emso" displayedName="EMŠO" placeholder="Vnesite EMŠO"
                             fa-icon="fa-solid fa-hashtag"
                             :value="$existingDataa[0]->emso ?? ''"/>
                </div>

                <div class="dropdown-group">
                    <label for="role">Tip uporabnika</label>
                    <div class="card-join-dropdown">
                        <select name="role" id="role" class="form-control">
                            @foreach($roles as $role)
                                <option
                                    value="{{ $role }}" {{ isset($existingData[0]->role) && $existingData[0]->role == $role ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="class"> Razred </label>
                    <div class="card-join-dropdown">
                        <select name="class" id="class">
                            <option disabled> Izberi razred</option>
                            @foreach($class as $c)
                                <option
                                    value="{{$c->id}}" {{ isset($existingDataa[0]->id_class) && $existingDataa[0]->id_class == $c->id ? 'selected': '' }}>{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="card-filter">Poišči kartico</label>
                    <div class="search-bar">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" id="card-filter" class="form-control" placeholder="Poišči kartico po imenu"/>
                    </div>

                    <label for="cards">Kartice</label>
                    <div class="select">
                        @php($i = 0)
                        @foreach($cardInfo as $card)
                            <div class="form-check card-item" data-card-name="{{ $card->name }}">
                                <input class="form-check-input" type="checkbox" name="cards[]" id="card-{{ $card->id }}"
                                       value="{{ $card->id }}" {{isset($userCards[$card->name]) && $userCards[$card->name] == $card->id  ? 'checked' : ''}}
                                ">
                                <label class="form-check-label" for="card-{{ $card->id }}">
                                    {{$card->name}}
                                </label>
                            </div>
                            @php($i = $i + 1)
                        @endforeach
                    </div>

                </div>
            </x-form>
        </div>
    </div>


    <script>
        const cardItems = document.querySelectorAll('.card-item');
        const cardFilter = document.getElementById('card-filter');

        cardFilter.addEventListener('input', function () {
            const filterValue = cardFilter.value.toLowerCase();

            cardItems.forEach(function (cardItem) {
                const cardName = cardItem.dataset.cardName.toLowerCase();
                cardItem.style.display = cardName.includes(filterValue) ? 'block' : 'none';
            });
        });
    </script>
@endsection
