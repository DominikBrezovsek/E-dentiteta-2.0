@extends('layout')

@section('content')
    @foreach($notification['card'] as $n)
        <div style="display: flex; flex-direction: row; gap: 2rem">
           <div>
               {{$n->data['id_user']}}
           </div>
            <div>
                <form action="{{ route('sad.profile.notifications.markAsRead', ['notification' => $n]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Označi kot prebrano</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection