@extends('layout')

@section('content')
<h2>Card verify</h2>
    @if(gettype($slug) != 'string')
        <h4>{{$slug['message']}}</h4>
        <p>Ime: {{$slug['ime']}}</p>
        <p>Priimek: {{$slug['priimek']}}</p>
        <p>Kartica: {{$slug['card']}}</p>
    @else
        {{$slug}}
    @endif

@endsection
