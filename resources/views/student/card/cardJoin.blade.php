@extends('layout')

@section('content')
    <div class="cards-about">
        <div class="cards-header">
            <h1>Pridruži se karticam</h1>
        </div>
        <div class="cards-table">
            <table class="table">
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
                                    <td>
                                        <form action="{{ route('student.card.create', ['cardId' => $row->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-add-card">Pridruži se kartici</button>
                                        </form></td>
                                @else
                                    <td><form action="{{ route('student.card.create', ['cardId' => $row->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-add-card">Zaprosi za kartico</button>
                                    </form>
                                    </td>
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
