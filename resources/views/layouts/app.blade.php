<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O nás</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@900&display=swap" rel="stylesheet">
    <style>
        h3 {
            font-family: 'Libre Franklin', sans-serif;
            color: #540202;
        }
        header {
            background-color: #EDE0A6;
        }

        footer {
            background-color: #507B58;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="row justify-content-between">
                <nav class="navbar navbar-expand-sm navbar-light">
                    <a href="#" class="navbar-brand mb-0 h1">
                        <img src="{{ asset('img/logo1.png') }}" alt="Logotyp" height="80">
                    </a>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active"><a href="#" class="nav-link">Úvod</a></li>
                        <li class="nav-item active"><a href="#" class="nav-link">Mapa</a></li>
                        <li class="nav-item active"><a href="#" class="nav-link">Dáta</a></li>
                        <li class="nav-item active"><a href="#" class="nav-link">Účet</a></li>
                    </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <footer class="">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h3>Ponuka</h3>
                </div>
                <div class="col-sm">
                    <h3>Informácie</h3>
                </div>
                <div class="col-sm">
                    <h3>Sociálne siete</h3>
                </div>
                <div class="col-sm">
                    <h3>Odoberať newsletter</h3>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>