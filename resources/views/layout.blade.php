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
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
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

        .btn-primary {
            background-color: transparent;
            color: #2b2c2c;
            border-color: rgb(71, 68, 68);
            padding: 10px 20px;
            margin: 10px;
        }

        .btn-primary:hover {
            background-color: transparent;
            border-color: transparent;
            color: #2b2c2c;
        }
        .btn{
            font-size: 20px;
            border-color: rgb(71, 68, 68);
            padding: 10px 20px;
            margin: 10px;
        }
    </style>
</head>

<body>
    @include('partials.header')
    <div class="main">
        @if (session('message'))
        <div class="alert alert-success auto-dismiss">
            {{ session('message') }}
        </div>
    @endif
        <div class="content">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
