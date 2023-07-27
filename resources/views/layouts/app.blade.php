<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WebFlame - {{$title}}</title>

    <link rel="shortcut icon" href="{{asset('assets/images/favicon/favicon-32x32.png')}}" type="image/x-icon" />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @section('head') @show

    @vite(['resources/css/app.scss'])

</head>
<body id="app-container">

    <header id="main-header">
        <a class="title-wrapper" href="{{route('home')}}">
            <img src="{{asset('assets/images/logo.png')}}" alt="Logo WebFlame">
            
            <h1>Web Flame</h1>
        </a>

        <div class="search-and-avatar">
            <div class="search-wrapper">
                <form method="GET" action="{{route('search')}}">
                    <input type="search" placeholder="Procurando algum vídeo?" name="q">
                </form>

                <ul class="results"></ul>
            </div>

            <div class="avatar-wrapper">
                @include('components.userIcon', [
                    'size' => '40px'
                ])
                
                <nav>
                    <div class="user-info">
                        <img src="https://64.media.tumblr.com/c250844c5d3473ec55e8dc7b1f375c77/80255ac43fe243e5-14/s400x600/e9d60ebdc69aa04424f65c210fcfd66a1ce6d281.jpg" alt="Ícone do Usuário">
                        
                        <p>Moyo Shoyo</p>
                    </div>

                    <ul class="main-navigation">
                        <li>
                            <a href="{{route('home')}}"><i class="fa-solid fa-house"></i> Página inicial</a>
                        </li>

                        <li>
                            <a href="{{route('profile')}}"><i class="fa-solid fa-user"></i> Perfil</a>
                        </li>

                        <li>
                            <a href="{{route('videos')}}"><i class="fa-solid fa-clapperboard"></i> Meus vídeos</a>
                        </li>
                    </ul>

                    <ul>
                        <li>
                            <a href="{{route('admin-home')}}"><i class="fa-solid fa-cookie-bite"></i> Administração</a>
                        </li>
                        <li>
                            <a href="{{route('authLogout')}}"><i class="fa-solid fa-door-closed"></i> Sair</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="main-content -{{$page}} {{$classes ?? ''}}"> @yield('main') </main>



    <script> 
        const publicPath = "{{asset('/assets')}}";
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>
    
    @section('scripts') @show
</body>
</html>