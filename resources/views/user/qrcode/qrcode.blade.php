@extends('layout')

@section('content')
<div>
    <h1>{{$cardName}}</h1>
    <div class="qr-code">
        {!! QrCode::size(500)->generate($payload)!!}
    </div>
    <div>
        <a href="{{route('user.cards')}}" class="btn btn-secondary">Nazaj</a>
    </div>
</div>

@endsection
