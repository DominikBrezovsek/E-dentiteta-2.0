@extends('layout')

@section('content')
    <div class="organisation-users">
        <div class="cards-content">
            <div class="card-header">
                <h1>Seznam vseh organizacij</h1>
            </div>
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="form-control" id="searchInput" onkeyup=" searchFunction()"
                       placeholder="Poišči uporabnika po emšu ali po mailu ali po uporabniškem imenu">
            </div>
            <div class="cards-table">
                <table class="table" id="userTable">
                    <tr>
                        <th>Ime organizacije</th>
                        <th>Opis organizacije</th>
                        <th>Možnosti</th>
                    </tr>
                    @if (!$organisations->isEmpty())

                        @if (count($organisations) > 0)
                            @foreach ($organisations as $row)
                                <tr>
                                    <td>{{ $row?->name }}</td>
                                    <td>{{ $row?->description }}</td>
                                    <td class="options">
                                        <form
                                            action="{{ route('user.organisations.add', ['organisationId' => $row?->id]) }}"
                                            method="POST">
                                            @method('POST')
                                            @csrf
                                            <div>
                                                <button type="submit" class="btn-delete"
                                                        onclick="return confirm('Se želite pridružiti tej organizaciji?');">
                                                    Zaprosi za pridružitev
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @else
                        <tr>
                            <td class="no-data">Ni podatkov o uporabnikih organizacije</td>
                            <td>/</td>
                            <td>/</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
        <div>
            {{$organisations->links('custom_vendor.pagination.default')}}
        </div>
    </div>
@endsection
