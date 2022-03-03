<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O nás</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@100;400;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            color: #540202;
            font-family: 'Libre Franklin', sans-serif;
        }

        h1 {
            font-size: 64px;
            font-weight: 900;
        }

        h3 {
            font-weight: 900;
        }
        .navbar-custom {
            background-color: #EDE0A6;
        }

        footer {
            background-color: #507B58;
        }

        .footer-link {
            color: #EDE0A6;
        }

        .footer-link:hover {
            color: #540202;
        }

        .footer-copyright
        {
            font-weight: 100;
            color: #540202;
        }

        .center-cropped
        {
            width: 100%;
            height: 100vh;
            object-fit: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>

    <div id="app">

        @yield('content')

    </div>

    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
