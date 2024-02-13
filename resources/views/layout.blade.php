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

@unless(Route::getCurrentRoute()->uri() == '/' || Route::getCurrentRoute()->uri() == 'register' || Route::getCurrentRoute()->uri() == 'password-reset' || Route::getCurrentRoute()->uri() == 'password-reset/set-new' )
    @include('partials.header')
@endunless

        @yield('content')
@if(session('message'))
    <script type="module">
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            showCloseButton: true,
            timer: 3000,
            color: "var(--text)",
            background: "var(--toast-background)",
            customClass: {
                timerProgressBar: 'progressBarToast',
                popup: 'popupToast',
                icon: 'popupIcon'
            },
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            /*title: "{{isset($errors->get('title')[0]) ? $errors->get('title')[0] : ''}}",*/
            text: "{{session('message')}}",
            icon: "success",
            iconColor: "var(--icon-color)"
        })
    </script>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/f618edc45d.js" crossorigin="anonymous"></script>
</body>
</html>
