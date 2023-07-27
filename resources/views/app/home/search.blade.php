@php

$videosSearch = [
    [
        'title' => 'Construindo o SISTEMA SOLAR no Minecraft - Em busca da casa automática #352',
        'thumbnail' => 'viniccius13.png',
        'canalName' => 'Viniccius13',
        'canalIcon' => 'viniccius13.png',
        'timeStamp' => '5 dias'
    ],
    [
        'title' => 'A Fantástica Farm de Morcego | O Filme | - Minecraft Em busca da casa automática #353',
        'thumbnail' => 'vin13.jpg',
        'canalName' => 'Viniccius13',
        'canalIcon' => 'viniccius13.png',
        'timeStamp' => '2 semanas'  
    ],
    [
            'title' => 'Construindo o SISTEMA SOLAR no Minecraft - Em busca da casa automática #352',
            'thumbnail' => 'viniccius13.png',
            'canalName' => 'Viniccius13',
            'canalIcon' => 'viniccius13.png',
            'timeStamp' => '5 dias'
        ],
        [
            'title' => 'A Fantástica Farm de Morcego | O Filme | - Minecraft Em busca da casa automática #353',
            'thumbnail' => 'vin13.jpg',
            'canalName' => 'Viniccius13',
            'canalIcon' => 'viniccius13.png',
            'timeStamp' => '2 semanas'  
        ],
        [
        'title' => 'Construindo o SISTEMA SOLAR no Minecraft - Em busca da casa automática #352',
        'thumbnail' => 'viniccius13.png',
        'canalName' => 'Viniccius13',
        'canalIcon' => 'viniccius13.png',
        'timeStamp' => '5 dias'
    ],
    [
        'title' => 'A Fantástica Farm de Morcego | O Filme | - Minecraft Em busca da casa automática #353',
        'thumbnail' => 'vin13.jpg',
        'canalName' => 'Viniccius13',
        'canalIcon' => 'viniccius13.png',
        'timeStamp' => '2 semanas'  
    ],
    [
            'title' => 'Construindo o SISTEMA SOLAR no Minecraft - Em busca da casa automática #352',
            'thumbnail' => 'viniccius13.png',
            'canalName' => 'Viniccius13',
            'canalIcon' => 'viniccius13.png',
            'timeStamp' => '5 dias'
        ],
        [
            'title' => 'A Fantástica Farm de Morcego | O Filme | - Minecraft Em busca da casa automática #353',
            'thumbnail' => 'vin13.jpg',
            'canalName' => 'Viniccius13',
            'canalIcon' => 'viniccius13.png',
            'timeStamp' => '2 semanas'  
        ]
];

$profiles = [
    [
        'name' => 'Viniccius13',
        'subs' => '4.560.50',
        'icon' => 'https://e0.pxfuel.com/wallpapers/904/967/desktop-wallpaper-about-girl-in-anime-icons.jpg'
    ],
    [
        'name' => 'DaviGamer',
        'subs' => '1.400.50',
        'icon' => 'https://i.pinimg.com/236x/72/62/7c/72627cbe125003ce7cedf877e1d7766e.jpg'
    ],
    [
        'name' => 'Viniccius13',
        'subs' => '4.560.50',
        'icon' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwpeJaeMm_m1F61hGBjB0qXrBm-9JDi5_4-Q&usqp=CAU'
    ],
    [
        'name' => 'DaviGamer',
        'subs' => '1.400.50',
        'icon' => 'https://pbs.twimg.com/media/FhDY4nKWAAAmoY6.jpg'
    ],[
        'name' => 'Viniccius13',
        'subs' => '4.560.50',
        'icon' => 'https://media.tenor.com/DDOLg4aNjTwAAAAd/anime-anime-boy.gif'
    ],
    [
        'name' => 'DaviGamer',
        'subs' => '03',
        'icon' => 'https://pm1.aminoapps.com/7846/c29aa598cbbc46b4ffbd23e447046fb6ee195b70r1-300-300v2_00.jpg'
],
[
        'name' => 'Viniccius13',
        'subs' => '4.560.50',
        'icon' => 'https://e0.pxfuel.com/wallpapers/904/967/desktop-wallpaper-about-girl-in-anime-icons.jpg'
    ],
    [
        'name' => 'DaviGamer',
        'subs' => '1.400.50',
        'icon' => 'https://i.pinimg.com/236x/72/62/7c/72627cbe125003ce7cedf877e1d7766e.jpg'
    ],
    [
        'name' => 'Viniccius13',
        'subs' => '4.560.50',
        'icon' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwpeJaeMm_m1F61hGBjB0qXrBm-9JDi5_4-Q&usqp=CAU'
    ],
    [
        'name' => 'DaviGamer',
        'subs' => '1.400.50',
        'icon' => 'https://pbs.twimg.com/media/FhDY4nKWAAAmoY6.jpg'
    ],[
        'name' => 'Viniccius13',
        'subs' => '4.560.50',
        'icon' => 'https://media.tenor.com/DDOLg4aNjTwAAAAd/anime-anime-boy.gif'
    ],
    [
        'name' => 'DaviGamer',
        'subs' => '03',
        'icon' => 'https://pm1.aminoapps.com/7846/c29aa598cbbc46b4ffbd23e447046fb6ee195b70r1-300-300v2_00.jpg'
    ]
];

@endphp

@extends('layouts.app', ['title' => 'Pesquisa', 'page' => 'search', 'search' => true])

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
@endsection

@section('main')
    
    @component('components.title')
        Resultado <i class="fa-solid fa-arrow-right"></i>

        @slot('secondaryContent') vinicius 13 @endslot
    @endcomponent


    <div class="main-profiles-wrapper">
        <h4>8 resultados de canais</h4>

        <ul class="owl-carousel">
            @foreach($profiles as $profile)
                <li class="element-profile">
                    <a href="#">
                        <img src="{{$profile['icon']}}" alt="Ícone do Canal">
                        <div class="infos-wrapper">
                            <h3>{{$profile['name']}}</h3>
                        
                            <small>{{$profile['subs']}} inscritos</small>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @include('components.cardVideo', ['videos' => $videosSearch, 'showTitle' => true])

@endsection

@section('scripts')

<script src="{{asset('assets/js/components/cardVideo.js')}}"></script>

<script src="{{asset('assets/js/pages/home/search.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection