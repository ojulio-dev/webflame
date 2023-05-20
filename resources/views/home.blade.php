@php

$videos = [
    [
        'title' => 'Yukirito e a jogada do Ninja',
        'thumbnail' => 'yukirito.png',
        'canalName' => 'Yukirito',
        'canalIcon' => 'yukirito.png',
        'timeStamp' => '13 horas'
    ],
    [
        'title' => 'Naruto Shippuden Openings 1-20 (HD)',
        'thumbnail' => 'naruto.png',
        'canalName' => 'Crunchyroll',
        'canalIcon' => 'crunchyroll.png',
        'timeStamp' => '4 anos'
    ],
    [
        'title' => 'a cada kill eu troco de MOUSE no HG',
        'thumbnail' => 'spop.png',
        'canalName' => 'Spop',
        'canalIcon' => 'spop.png',
        'timeStamp' => '14 dias'
    ],
    [
        'title' => 'A LENDA DE FABINHO E SCARLAITI DE ORR',
        'thumbnail' => 'alan.png',
        'canalName' => 'Alanzoka',
        'canalIcon' => 'alan.png',
        'timeStamp' => '5 anos'
    ],
    [
        'title' => "GTA COM 4 PESSOAS (no modo história '-')",
        'thumbnail' => 'saiko.png',
        'canalName' => 'Saiko Joga',
        'canalIcon' => 'saiko.png',
        'timeStamp' => '3 anos'
    ],
    [
        'title' => 'Construindo o SISTEMA SOLAR no Minecraft - Em busca da casa automática #352',
        'thumbnail' => 'viniccius13.png',
        'canalName' => 'Viniccius13',
        'canalIcon' => 'viniccius13.png',
        'timeStamp' => '5 dias'
    ]
];

@endphp

@extends('layouts.app', ['title' => 'Pagina Inicial'])

@section('headerContent')

    <input type="search" placeholder="Procurando algum vídeo?">
    
@endsection

@section('main')

    <section class="main-section -home">

        @if (count($videos))

            <ul class="main-videos-wrapper">
                @foreach($videos as $video)

                    @include('components.cardVideo', [
                        'thumbnail' => $video['thumbnail'],
                        'title' => $video['title'],
                        'canalName' => $video['canalName'],
                        'timeStamp' => $video['timeStamp']
                    ])

                @endforeach
            </ul>

        @else
            <span style="display: block; text-align:center">Nenhum vídeo foi publicado.</span>
        @endif

    </section>

@endsection

@section('scripts')

    <script src="{{asset('assets/js/pages/home.js')}}"></script>

@endsection