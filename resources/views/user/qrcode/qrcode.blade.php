@extends('layout')

@section('content')
@php
use \App\Models\UserCard;
use \App\Models\Card;
use \App\Models\CardVerification;
$url = parse_url(URL::full(), PHP_URL_PATH);
$cardId = explode('/', $url)[4];

$cardData = UserCard::where('id_card', '=', $cardId)->where('id_user', '=', session('user')['id'])->join('cards', 'id_card', '=', 'cards.id')->first();
 @endphp
<div>
    <h1>{{$cardData->name}}</h1>
    <div class="qr-code">
        @php
            CardVerification::whereIdUser($cardData->id_user)->whereIdCard($cardData->id_card)->delete();
            $chkSeq = uuid_create();
            $payload = 'uid='.$cardData->id_user.'?'.'cid='.$cardData->id_card.'?'.'chk='.$chkSeq;

            DB::table('card_verifications')->insert([
                'id_verify' => uuid_create(),
                'id_user' => $cardData->id_user,
                'id_card' => $cardData->id_card,
                'check_seq' => $chkSeq,
                'expires' => time() + 2*60
]);
        @endphp
        {!! QrCode::size(500)->generate($payload)!!}
    </div>
    <div>
        <a href="{{route('user.cards')}}" class="btn btn-secondary">Nazaj</a>
    </div>
</div>

@endsection
