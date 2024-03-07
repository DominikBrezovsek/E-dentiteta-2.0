@extends('layout')

@section('content')
    <div class="student-cards">
        <div class="cards-header">
            <h1>Podatki o karticah</h1>
            <a href="{{ route('student.card.join')}}"
               class="btn btn-add-card">Dodaj kartico v svoj račun</a>
        </div>

        <div class="cards">
                @if (!$data->isEmpty())
                    @if (count($data) > 0)
                        @foreach ($data as $row)
                            <div class="card">
                                <div class="logo"><img src="{{Storage::url('images/'.$row->logo)}}" alt="KER logo">
                                    <div>
                                        <h4>{{$row->name}}</h4>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="user-info">
                                        <h3>{{$row->user_name}} {{$row->user_surname}}</h3>
                                    </div>
                                    <div class="org-info">
                                        <h3>Veljavno od: {{$row->created_at}}</h3>
                                        <h3>Izdal: {{$row->o_name}}</h3>
                                    </div>
                                </div>
                                <a href="{{ route('student.qrcode-generate', ['cardId' => $row->id]) }}">
                                    <div class="btn-verify">
                                        <h3>Verifikacija veljavnosti</h3>
                                    </div>
                                </a>
                                <div class="card-id">
                                    <p>Št. izkaznice: {{$row->ucId}}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @else
                    <div class="no-data">
                        <h1>Ni dodeljenih kartic</h1>
                    </div>
                @endif
        </div>
    </div>
@endsection
