<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('/css/public-layout.css')}}">
    <script src="https://kit.fontawesome.com/9aa910470c.js" crossorigin="anonymous"></script>
    <title>Admin Projetos</title>
</head>
<body>
<header>
    @auth()
    <nav class="navbar navbar-expand-lg navbar-dark mb-2 p-3 w-100">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('admin_projects.index')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('profiles.index')}}">Perfis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('logout')}}">Sair</a>
                </li>
            </ul>
        </div>
    </nav>
    @endauth
</header>

<main>
    <div class="container">
        {{$slot}}
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
