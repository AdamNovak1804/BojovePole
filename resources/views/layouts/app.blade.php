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

        .textarea
        {
            outline: none;
            border: 2px solid #540202;
            border-radius: 5px;
            padding: 10px;
            background-color: #EDE0A6;
            resize: none;
            width: 100%;
            box-shadow: none;
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

        .modal-title
        {
            text-align: center;
            font-weight: 900;
        }

        .view-carousel
        {
            box-shadow: 0px 2px 3px #999;
        }

        .sr-only
        {
            border: 0 !important;
            clip: rect(1px, 1px, 1px, 1px) !important; /* 1 */
            -webkit-clip-path: inset(50%) !important;
            clip-path: inset(50%) !important; /* 2 */
            height: 1px !important;
            margin: -1px !important;
            overflow: hidden !important;
            padding: 0 !important;
            position: absolute !important;
            width: 1px !important;
            white-space: nowrap !important; /* 3 */
        }

        .carousel-control-next-icon
        {
            background-image: url('/images/next-slide.png');
            background-size: cover;
            width: 32px;
            height: 32px;
        }

        .carousel-control-prev-icon
        {
            background-image: url('/images/prev-slide.png');
            background-size: cover;
            width: 32px;
            height: 32px;
        }

        .slide-img
        {
            width:100%;
            height: 400px !important;
            object-fit: contain;
        }

        .modal-info
        {
            border-radius: 15px;
            background-color: #EDE0A6;
            padding: 10px;
        }

        .modal-info ul
        {
            margin-bottom: 0;
            list-style: none;
            padding-left: 0;
        }

        .modal-info li
        {
            padding-bottom: 5px;
        }

        .modal-info li:last-child
        {
            padding-bottom: 0px;
        }

        .modal-text
        {
            border-radius: 15px;
            padding: 10px;
            background-color: #EDE0A6;
        }

        .list-group-item p
        {
            margin-bottom: 0;
        }

        .card-preview
        {
            width: 400px;
        }

        .card-text
        {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
        }

        .options
        {
            border: 2px solid #540202;
            border-radius: 5px;
            background-color: #EDE0A6;
            padding: 8px 5px 8px 5px;
            width: 100%;
        }

        .options-inverted
        {
            border: 2px solid #540202;
            border-radius: 5px;
            background-color: #540202;
            padding: 8px 5px 8px 5px;
            width: 100%;
            color: #EDE0A6;
        }

        .label-form
        {
            margin-top: 8px;
            padding: 5px 0px 5px 0px;
        }

        .dropbox
        {
            outline: 2px dashed #540202;
            outline-offset: -5px;
            background-color: #EDE0A6;
            position: relative;
            cursor: pointer;
        }

        input[type="file"]
        {
            opacity: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            cursor: pointer;
        }

        .dropbox p
        {
            margin: 0;
            text-align: center;
            padding: 30px 5px 30px 5px;
        }

        .list
        {
            list-style: none;
            padding-left: 0;
        }

        .list li
        {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .img-link
        {
            border: 2px solid #540202;
            border-radius: 15px;
            padding: 5px 10px 5px 10px;
            background-color: #EDE0A6;
        }

        .img-link a
        {
            color: #540202;
        }

        .img-link-delete
        {
            border-radius: 50%;
            outline: none;
            border: none;
            background-image: url('/images/remove.png');
            background-size: cover;
            height: 20px;
            width: 20px;
        }

        .label-center
        {
            display: block;
            text-align: center;
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
