<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O nás</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@100;400;700;900&display=swap" rel="stylesheet">
    <style>
        *
        {
            color: #540202;
            font-family: 'Libre Franklin', sans-serif;
        }

        h1
        {
            font-size: 64px;
            font-weight: 900;
        }

        h2
        {
            font-weight: 700;
        }

        h3
        {
            font-weight: 900;
        }

        .center-cropped
        {
            width: 100%;
            height: 100vh;
            object-fit: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }

        ::placeholder
        {
            color: #998067;
        }

        input[type=text], input[type=password], input[type=email], input[type=text]:focus, input[type=password]:focus, input[type=email]:focus
        {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: none;
            outline: none;
            border-bottom: 2px solid #540202;
        }

        .btn-action
        {
            color: #EDE0A6;
            background-color: #540202 !important;
            width: 100%;
        }

        .btn-action:hover
        {
            color: #FFF;
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
