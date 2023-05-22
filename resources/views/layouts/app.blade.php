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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.scss'])

</head>
<body>
    
    @if (!isset($hideHeader))

        <header class="header">
            <a class="header-title-wrapper" href="{{route('home')}}">
                <img src="{{asset('assets/images/logo.png')}}" alt="Logo WebFlame">
                
                <h1>Web Flame</h1>
            </a>

            <div class="header-search-wrapper">
                @section('headerContent') @show

                <img src="{{asset('assets/images/profile.png')}}" alt="User Icon">
            </div>
        </header>

    @endif

    <main class="main-content -{{$content}}"> @yield('main') </main>

    <script> const publicRouter = "{{asset('/assets')}}"; </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>
    
    @section('scripts') @show
</body>
</html>