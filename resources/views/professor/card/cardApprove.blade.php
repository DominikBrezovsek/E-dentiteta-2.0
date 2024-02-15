@extends('layout')

@section('content')
    <div class="card-approve">
        <div class="cards-content">
            <div class="card-header"><h1>{{ __('Zahtevki za dodelitev kartice') }}</h1></div>
            <div class="card-body">
                <div class="cards-table">
                    <table class="table">
                        <tr>
                            <th>Ime kartice</th>
                            <th>Podatki uporabnika</th>
                            <th colspan="2">Možnosti</th>
                        </tr>

                        @if (count($data) > 0)

                            @if (!$data->isEmpty())
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $row?->card_name }}</td>
                                        <td>
                                            <div onclick="showUserInfo()" data-bs-toggle="popover"
                                                 title="Informacije o uporabniku">
                                                {{ $row?->name }} {{ $row?->surname }}
                                            </div>
                                        </td>
                                        <div>
                                            <td class="options">
                                                <form
                                                    action="{{ route('professor.card.approve.card', ['requestId' => $row?->id_request_card]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div>

                                                        <button type="button" class="btn-approve"
                                                                onclick="approveCard(event, this.parentNode.parentNode)">
                                                            Odobri
                                                        </button>
                                                    </div>
                                                </form>
                                                <form
                                                    action="{{ route('professor.card.decline.card', ['requestId' => $row?->id_request_card]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class=>
                                                        <button type="button" class="btn-reject"
                                                                onclick="rejectCard(event, this.parentNode.parentNode)">
                                                            Zavrni
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </div>
                                    </tr>
                                @endforeach
                            @endif
                        @else
                            <tr>
                                <td>Ni podatkov o zahtevah za kartico</td>
                                <td>/</td>
                                <td>/</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>

        function showUserInfo() {
            Swal.fire({
                title: "Podatki o uporabniku",
                @isset($row)
                html: "<div class='userData'>" +
                    "<div><p>Ime</p>: {{$row->name}}</div>" +
                    "<div><p>Priimek</p>: {{$row?->surname}}</div>" +
                    "<div><p>E-poštni naslov</p>: {{$row?->email}}</div>" +
                    "<div><p>EMŠO<p>: {{$row?->emso}}</div>" +
                    "</div>",
                @endisset
                confirmButtonText: 'Zapri',
            })
        }

        function rejectCard(event, form) {
            event.preventDefault();
            @isset($row)
            Swal.fire({
                title: 'Potrditev dejanja',
                text: 'Želite uporabniku {{$row->name}} {{$row->surname}} zarvrniti prošjno za kartico {{$row->card_name}}',
                showDenyButton: true,
                denyButtonText: 'Zavrni prošnjo',
                confirmButtonText: 'Nazaj',
                icon: 'warning',
            }).then((result) => {
                if (result.isDenied) {
                    form.submit();
                }
            })
            @endisset
        }

        function approveCard(event, form) {
            event.preventDefault();
            @isset($row)
            Swal.fire({
                title: 'Potrditev dejanja',
                text: 'Želite uporabniku {{$row->name}} {{$row->surname}} odobriti prošjno za kartico {{$row->card_name}}',
                showDenyButton: true,
                denyButtonText: 'Odobri kartico',
                confirmButtonText: 'Nazaj',
                icon: 'warning',
            }).then((result) => {
                if (result.isDenied) {
                    form.submit();
                }
            });
            @endisset
        }

    </script>
@endsection
