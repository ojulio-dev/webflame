<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WebFlame - Administração</title>

    @section('head') @show

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="{{asset('assets/images/favicon/favicon-32x32.png')}}" type="image/x-icon">

    @vite(['resources/css/admin.scss'])
</head>
<body id="admin-container">

    <aside>
        <img src="{{asset('assets/images/logo.png')}}" alt="Logo WebFlame">

        <ul>
            <li>
                <a href="{{route('admin-home')}}"><i class="fa-solid fa-house"></i> Início</a>
            </li>

            <li>
                <a href="{{route('admin-videos')}}"><i class="fa-solid fa-video"></i> Vídeos</a>
            </li>

            <li>
                <a href="{{route('admin-users')}}"><i class="fa-solid fa-user"></i> Usuários</a>
            </li>
            
            <li>
                <a href="#"><i class="fa-solid fa-gear"></i> Configurações</a>
            </li>

            <li>
                <a href="{{route('home')}}"><i class="fa-solid fa-door-closed"></i> Sair</a>
            </li>
        </ul>
    </aside>

    <div class="main-content">
        <header>
            
            <input type="search" placeholder="Pesquisar">

            <img src="{{asset('assets/images/users/default.jpg')}}" alt="Ícone do Usuário">
        </header>

        <main>
            <div class="page-content -{{$page}}">
                <h1>{{$title}}</h1> 
                
                @yield('main') 
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        const publicPath = "{{asset('/')}}";

    </script>

    @section('scripts') @show

</body>
</html>