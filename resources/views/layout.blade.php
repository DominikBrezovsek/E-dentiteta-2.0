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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
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
    </style>
</head>

<body>
    @include('partials.header')
    <div class="main">
        <div class="content">   
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
