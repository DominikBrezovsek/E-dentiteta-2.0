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
    <title>{{ $title ?? 'E-dentiteta' }}</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .content {
            display: flex;
            width: 100%;
            height: 100%;
            overflow: hidden;
            padding: 10px;
        }
    </style>
</head>

<body>
    @include('partials.header')
    <div class="main">
        <div class="content">
            Ju
            {{-- @yield('content') --}}
        </div>
    </div>
</body>

</html>
