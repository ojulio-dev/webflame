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

    @include('components.loader')

    @include('components.closeElements', ['elements' => '#navigation-menu-element, #results-search-element, .main-actions-menu .options'])

    <header id="main-header">
        <a class="title-wrapper" href="{{route('home')}}">
            <img src="{{asset('assets/images/logo.png')}}" alt="Logo WebFlame">
            
            <h1>Web Flame</h1>
        </a>

        <div class="search-and-avatar">
            <div class="search-wrapper">
                <form method="GET" action="{{route('search')}}">
                    <input type="search" placeholder="Procurando algum vídeo?" name="q" autocomplete="off">
                </form>

                <ul class="results" id="results-search-element"></ul>
            </div>

            <div class="avatar-wrapper">
                @include('components.userIcon', [
                    'size' => '40px',
                    'source' => asset('assets/images/users/' . $globalDataUser['icon'])
                ])
                
                <nav id="navigation-menu-element">
                    <div class="user-info">
                        <img src="{{asset('assets/images/users/' . $globalDataUser['icon'])}}" alt="Ícone do Usuário">
                        
                        <p>{{$globalDataUser['name']}}</p>
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

                    <ul class="main-navigation">
                        <li>
                            <a class="modal-action"><i class="fa-solid fa-comment"></i> Mensagens <span>(0)</span></a>
                        </li>
                    </ul>

                    <ul>
                        @if ($globalDataUser['isAdmin'])
                            <li>
                                <a href="{{route('admin-home')}}"><i class="fa-solid fa-cookie-bite"></i> Administração</a>
                            </li>
                        @endif

                        <li>
                            <a href="{{route('authLogout')}}"><i class="fa-solid fa-door-closed"></i> Sair</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    @include('components.flashMessage')

    <main class="main-content -{{$page}} {{$classes ?? ''}}"> @yield('main') </main>

    @component('components.modal')
        
        @slot('modalName', 'message-menu')

        @slot('title', 'Mensagens')

        <div class="messages-wrapper">

            <ul class="users-wrapper">

                <li class="-selected">

                    <div class="icon-wrapper">

                        <img src="https://i.pinimg.com/736x/d6/0b/60/d60b60df9147a88c660bc1452385c3a7.jpg" alt="Ícone do Usuário">

                        <span>3</span>

                    </div>


                    <div class="infos-wrapper">

                        <p>Guts</p>

                        <small>Ah então mano, tinha que tá vendo</small>

                    </div>

                </li>

                <li>

                    <div class="icon-wrapper">

                        <img src="https://i.pinimg.com/736x/7d/64/c2/7d64c29b20f1ce5296ae39009dc2f615.jpg" alt="Ícone do Usuário">

                        <span>31</span>

                    </div>

                    <div class="infos-wrapper">

                        <p>Griffith</p>

                        <small>Cala boca aí tio, fica suave ai parceirinho</small>

                    </div>

                </li>

                <li>

                    <div class="icon-wrapper">

                        <img src="https://i.pinimg.com/736x/c5/a9/68/c5a968eb0a92b427ca26646cf55526bb.jpg" alt="Ícone do Usuário">

                    </div>

                    <div class="infos-wrapper">

                        <p>Zoro</p>

                        <small>Forte abraço</small>

                    </div>

                </li>

            </ul>

            <div class="message-box">

                <div class="header">
                    <div class="icon-wrapper">

                        @include('components.userIcon', [
                            'size' => '75px',
                            'source' => 'https://i.pinimg.com/736x/d6/0b/60/d60b60df9147a88c660bc1452385c3a7.jpg'
                        ])
                        
                    </div>

                    <div class="infos-wrapper">
                        <h4>Gutsu</h4>
                    </div>
                </div>

                <ul class="messages-wrapper">

                    <li class="-sent">

                        @include('components.userIcon', [

                            'size' => '35px',
                            'source' => asset('assets/images/users/' . $globalDataUser['icon'])

                        ])

                        <div class="message-wrapper">
                            
                            <p>Oi</p>
    
                            <small>14:19</small>

                        </div>

                    </li>

                    <li class="-received">

                        @include('components.userIcon', [

                            'size' => '35px',
                            'source' => 'https://i.pinimg.com/736x/d6/0b/60/d60b60df9147a88c660bc1452385c3a7.jpg'

                        ])

                        <div class="message-wrapper">
                            
                            <p>Olá</p>
    
                            <small>14:19</small>

                        </div>

                    </li>

                    <li class="-sent">

                        @include('components.userIcon', [

                            'size' => '35px',
                            'source' => asset('assets/images/users/' . $globalDataUser['icon'])

                        ])

                        <div class="message-wrapper">
                            
                            <p>Tudo bem?</p>
    
                            <small>14:19</small>

                        </div>

                    </li>

                    <li class="-received">

                        @include('components.userIcon', [

                            'size' => '35px',
                            'source' => 'https://i.pinimg.com/736x/d6/0b/60/d60b60df9147a88c660bc1452385c3a7.jpg'

                        ])

                        <div class="message-wrapper">
                            
                            <p>Tudo bem e você?</p>
    
                            <small>14:19</small>

                        </div>

                    </li>

                    <li class="-sent">

                        @include('components.userIcon', [

                            'size' => '35px',
                            'source' => asset('assets/images/users/' . $globalDataUser['icon'])

                        ])

                        <div class="message-wrapper">
                            
                            <p>Que bom, estou bem também</p>
    
                            <small>14:19</small>

                        </div>

                    </li>
                    
                    <li class="-received">

                        @include('components.userIcon', [

                            'size' => '35px',
                            'source' => 'https://i.pinimg.com/736x/d6/0b/60/d60b60df9147a88c660bc1452385c3a7.jpg'

                        ])

                        <div class="message-wrapper">
                            
                            <p>kkkkkkkkkkkkkj sai fora</p>
    
                            <small>14:19</small>

                        </div>

                    </li>

                </ul>

                <div class="send-message-wrapper">

                    <div class="send-comment">
                        @include('components.userIcon', [
                            'size' => '45px',
                            'source' => asset('assets/images/users/' . $globalDataUser['icon'])
                        ])
        
                    <form class="input-wrapper">
                        <input name="comment" id="comment" placeholder="Envia algo legal...">
        
                        <button class="send-icon">
                            <img src="{{asset('assets/images/icons/send.png')}}" alt="Send Icon">
                        </button>
                    </form>
                </div>

                </div>

            </div>

        </div>

    @endcomponent

    <script> 

        const PUBLIC_PATH = "{{asset('/assets')}}";

        const APP_PATH = "{{Config::get('app.domain')}}";

        const API_PATH = "{{Config::get('app.domain')}}/api";

        const USER_INFOS = JSON.parse('<?= json_encode(Auth::user()) ?>');

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('assets/js/components/loader.js')}}"></script>

    <script src="{{asset('assets/js/components/button.js')}}"></script>

    <script src="{{asset('assets/js/components/flashMessage.js')}}"></script>

    <script src="{{asset('assets/js/components/closeElements.js')}}"></script>

    <script src="{{asset('assets/js/components/modal.js')}}"></script>

    <script src="{{asset('assets/js/components/actionsMenu.js')}}"></script>

    <script src="{{asset('assets/js/messageMenu.js')}}"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>
    
    @section('scripts') @show
</body>
</html>