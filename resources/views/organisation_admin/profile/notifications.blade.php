@extends('layout')

@section('content')
    <div class="notification-list">
        @foreach($notification[0] as $n)
            <div class="notification-card">
                <div style="color: var(--text)">
                    {{$n->data['message']}}
                </div>
                <div>
                    <form
                        action="{{ route('organisation_admin.profile.notifications.markAsRead', ['notification' => $n]) }}"
                        method="POST">
                        @csrf
                        <button type="submit" class="btn-mark-as-read" style="color: var(--text);" onmouseover="showButton(event, this)"><i class="fa-solid fa-check"></i>
                        </button>
                    </form>
                </div>
            </div>
    </div>
    @endforeach

    <script>
        function showButton(event, button) {
            event.preventDefault();

        }
    </script>
@endsection
