<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.auto-dismiss');

            alerts.forEach(alert => {
                setTimeout(function() {
                    alert.style.opacity = "0";
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }, 3000);
            });
        });
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <title>{{ $title ?? 'E-dentiteta' }}</title>
</head>

<body>

@unless(Route::getCurrentRoute()->uri() == '/' || Route::getCurrentRoute()->uri() == 'register')
    @include('partials.header')
@endunless
        @if (session('message'))
        <div class="alert alert-success auto-dismiss">
            {{ session('message') }}
        </div>
    @endif
        @yield('content')


<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
</body>
</html>
