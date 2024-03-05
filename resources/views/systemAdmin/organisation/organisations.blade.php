@extends('layout')

@section('content')
<div style="padding:auto">
    <div class="cards-about">
        <div class="cards-header">
            <h1>Podatki o organizacijah</h1>
            <div>
                <a href="{{ route('sad.add-organisation') }}" class="btn btn-add-card">Dodaj organizacijo</a>
            </div>
        </div>
        <div class="cards-table">
            <table class="table">
                <tr>
                    <th>Ime organizacije</th>
                    <th>Preverjeno</th>
                    <th colspan="2">Upravljanje z organizacijo</th>
                </tr>

                @if (!$data->isEmpty())

                    @if (count($data) > 0)
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $row?->name }}</td>
                                @if ($row?->verified == 'Y')
                                    <td><svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                                            fill="var(--success)" class="bi bi-check text-success icon-lg"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                        </svg></td>
                                @else
                                    <td><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="var(--alert)" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path
                                                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                        </svg></td>
                                @endif
                                <td>
                                    <div class="options">
                                        <a href="{{ route('sad.organisation', ['organisationId' => $row->id]) }}"
                                            class="btn btn-edit">Uredi</a>
                                        <form
                                            action="{{ route('sad.organisation.delete', ['organisationId' => $row->id]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn-delete"
                                            onclick="deleteOrganisation(event, this.parentNode)">
                                                Izbriši
                                            </button>

                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                @else
                    <tr>
                        <td colspan="4" class="text-center">Ni podatkov o organizacijah</td>
                    </tr>
                @endif
            </table>
        </div>
        <div>
            {{$data->links('custom_vendor.pagination.default')}}
        </div>
    </div>

</div>    
    <script>
        function deleteOrganisation(event, form) {
            event.preventDefault();
            @isset($row)
            Swal.fire({
                title: 'Potrditev dejanja',
                text: 'Želite izbrisati organizacijo {{$row->name}} ? Tega dejanja ni mogoče razveljaviti!',
                showDenyButton: true,
                denyButtonText: 'Izbriši organizacijo',
                confirmButtonText: 'Prekliči',
                icon: 'warning',
            }).then((result) => {
                if (result.isDenied) {
                    form.submit();
                }
            })
            @endisset
        }
    </script>
@endsection
