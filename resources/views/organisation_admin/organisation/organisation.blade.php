@extends('layout')

@section('content')
    <div class="organisation-data">
        <div class="organisation-header">Upravljanje z organizacijo</div>
        @if(isset($organisationData))
        <div class="organisation-logo">
            <img src="{{Storage::url('images/'.$organisationData->logo)}}" alt="Organisation logo">
        </div>
            <div class="organisation-info">
                <h3>{{$organisationData->name}}</h3>
            </div>
        @endif
    </div>
@endsection
