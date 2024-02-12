@extends('layout')

@section('content')
    <div class="card-approve">
        <div class="card-header">{{ __('Zahtevki za dodelitev kartice') }}</div>
        <div class="card-body">
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

                                <td><form
                                    action="{{ route('organisation.card.approve.card', ['requestId' => $row?->id_request_card]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="d-flex gap-2">

                                        <button type="button" class="btn btn-primary"
                                            onclick="approveCard(event, this.parentNode.parentNode)">
                                            Odobri
                                        </button>
                                    </div>
                                </form></td>
                                <td>
                                    <form
                                        action="{{ route('organisation.card.decline.card', ['requestId' => $row?->id_request_card]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="btn-reject">
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                onclick="rejectCard(event, this.parentNode.parentNode)">
                                                Zavrni
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @else
                    <tr>
                        <td colspan="4" class="text-center">Ni podatkov o zahtevah za kartico</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <script>

        function showUserInfo(){
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
        function rejectCard(event, form){
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
                if(result.isDenied){
                    form.submit();
                }
            })
            @endisset
        }
        function approveCard(event, form){
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
                if(result.isDenied){
                    form.submit();
                }
            });
            @endisset
        }

        </script>
@endsection
