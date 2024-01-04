@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Pridruži se karticam</h1>
        </div>
        <div class="col-md-12 table-responsive card-body">
            <table class="table table-striped">
                <tr>
                    <th>Ime kartice</th>
                    <th>Opis</th>
                    <th colspan="2">Pridružitev</th>
                </tr>

                @if (!$data->isEmpty())

                    @if (count($data) > 0)
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $row?->name }}</td>
                                <td>{{ $row?->description }}</td>
                                @if ($row?->auto_join == 'Y')
                                    <td><a href="{{ route('user.card', ['cardId' => $row?->id]) }}"
                                            class="btn btn-primary">Pridruži se kartici</a></td>
                                @else
                                    <td><a href="{{ route('user.card.join', ['cardId' => $row?->id]) }}"
                                            class="btn btn-primary">Zaprosi za kartico</a></td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                @else
                    <tr>
                        <td colspan="4" class="text-center">Ni več katric katerim se lahko pridružite ali za njih
                            zaprosite</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@endsection
