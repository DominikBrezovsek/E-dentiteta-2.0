@extends('layout')

@section('content')
    @foreach($notification[0] as $n)
        <div style="display: flex; flex-direction: row; gap: 2rem">
            <div style="color: var(--text)">
                {{$n->data['message']}}
            </div>
            <div>
                <form action="{{ route('organisation_admin.profile.notifications.markAsRead', ['notification' => $n]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="color: var(--text);">Označi kot prebrano</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection
