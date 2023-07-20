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

@extends('layouts.app', ['title' => 'Moyo Shoyo', 'page' => 'findUser', 'search' => true])

@section('main')

    <div class="main-user-info">

        <div class="user-info-wrapper">
    
            @include('components.userIcon', [
                'size' => '80px',
                'source' => 'https://pbs.twimg.com/media/Eb4X_4FWAAAfA-K.png'
            ])
    
            <div class="important-infos">
                <h4>Moyo Shoyo</h4>
                <small>54 inscritos</small>
            </div>
            
        </div>

        <div class="button-and-actions-menu">
            @include('components.button', ['text' => 'Inscrito', 'classes' => '-subscriber'])

            @component('components.actionsMenu')
                <li><i class="fa-solid fa-flag"></i> Reportar usuário</li>
                <li><i class="fa-solid fa-comment"></i> Enviar mensagem</li>
            @endcomponent
        </div>
    </div>

    <nav>
        <ul>
            <li data-section="videos" class="selected"><span>Vídeos</span></li>
            <li data-section="about"><span>Sobre</span></li>
        </ul>
    </nav>

    <section class="navigation-section">

        <div class="section-content -videos">
            @include('components.cardVideo', ['videos' => $videos])
        </div>

        <div class="section-content -about">
            <div class="about-wrapper">

                <div class="info-wrapper">
                    <h3>Descrição</h3>
    
                    <p>Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo</p>
                </div>
    
                <div class="info-wrapper">
                    <h3>Outras informações</h3>
    
                    <p>Canal criado em 2023</p>
    
                    <p>3.500 visualizações</p>
                </div>
            </div>
        </div>
        
    </section>


@endsection

@section('scripts')

    <script src="{{asset('assets/js/pages/user/findUser.js')}}"></script>

    <script src="{{asset('assets/js/components/cardVideo.js')}}"></script>

    <script src="{{asset('assets/js/components/actionsMenu.js')}}"></script>

@endsection