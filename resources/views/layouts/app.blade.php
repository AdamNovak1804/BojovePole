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

        body
        {
            background-color: #FFF;
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

        .profile-pic
        {
            border-radius: 50%;
            border: 2px solid #540202;
        }

        textarea
        {
            padding: 10px;
            outline: none;
            border: none;
            border-radius: 15px;
            width: 100%;
            resize: none;
            box-shadow: 0px 2px 3px #999;
        }

        .date-input
        {
            border: 2px solid #540202;
            border-radius: 5px;
            background-color: #EDE0A6;
            padding: 5px;
            width: 100%;
        }
        
        .close
        {
            float: right;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            opacity: .5;
        }

        button.close
        {
            background-color: transparent;
            border: 0;
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
