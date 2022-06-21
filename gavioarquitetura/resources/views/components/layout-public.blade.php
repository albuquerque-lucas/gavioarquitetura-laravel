<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/public-layout.css')}}">
    <link rel="stylesheet" href="{{asset('/css/home.css')}}">
    <link rel="stylesheet" href="{{asset('/css/about-us.css')}}">
    <link rel="stylesheet" href="{{asset('/css/mail.css')}}">
    <link rel="stylesheet" href="{{asset('/css/projects.css')}}">
    <link rel="stylesheet" href="{{asset('/css/show.css')}}">
    <script src="https://kit.fontawesome.com/9aa910470c.js" crossorigin="anonymous"></script>
    <title>{{$title}}</title>
</head>
<body>
<header>

    <button type='button' class='nav-button'>
        <i class="fas fa-bars"></i>
    </button>

    <div id="logo">
        <a href="{{route('home')}}">
            <img src="{{asset('/storage/assets/gavio-arquitetura-icone-02.png')}}" alt="" srcset="">
        </a>
    </div>

    <nav class="nav-menu">
        <div id="menu-logo"><img src="../../src/Images/assets/gavio-arquitetura-icone-02.png" alt=""></div>
        <ul>
            <li class="menu-item"><a href="{{route('quem_somos')}}">quem somos</a></li>
            <li class="menu-item"><a href="{{route('projetos')}}">projetos</a></li>
            <li class="menu-item"><a href="{{route('email')}}">contato</a></li>
        </ul>
    </nav>

    <div id="titulo-marca">
        <a href="{{route('home')}}">
            <img src="{{asset('/storage/assets/gavio-arquitetura-escrita-02.png')}}" alt="">
        </a>
    </div>

</header>

<main>
<section>

    {{$slot}}

</section>

    <footer class='main-footer'>

            <div class="footer-content">
                <div class="footer-social-info">
                    <div class="footer-social-media">
                        <a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.instagram.com/isagavio.arq/" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="footer-adress">
                        <p>Rua Ataliba de Barros, 182, São Mateus - Juiz de Fora (Rossi 360 Business, sala 407)</p>
                        <p>2021 - Todos os direitos reservados.</p>
                    </div>

                </div>
            </div
            <div class="footer-content">
                <div class="footer-form">
                    <strong>Entre em contato conosco!</strong>
                    <form action="index.php" method="POST">

                        <input type="text" name='nome' placeholder='Seu nome'>

                        <input type="text" name='email' placeholder='Seu e-mail'>

                        <input type="text" name='assunto' placeholder='Digite um assunto'>

                        <textarea name="mensagem" id="message-text" placeholder='Mensagem'></textarea>
                        <button type='submit' name='submit'>Enviar</button>
                    </form>

                </div>
            </div>


    </footer>

</main>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
