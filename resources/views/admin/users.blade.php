@php

$users = [
    [
        'icon' => 'default.jpg',
        'name' => 'Moyo Shoyo',
        'description' => 'Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo',
        'created_at' => '11-21-2005',
        'total_videos' => 32,
        'subscribers' => 54
    ],
    [
        'icon' => 'default.jpg',
        'name' => 'Nome do Usuário 1',
        'description' => 'Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo',
        'created_at' => '11-21-2005',
        'total_videos' => 10,
        'subscribers' => 100
    ],
    [
        'icon' => 'default.jpg',
        'name' => 'Nome do Usuário 2',
        'description' => 'Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo',
        'created_at' => '11-21-2005',
        'total_videos' => 20,
        'subscribers' => 200
    ],
    [
        'icon' => 'default.jpg',
        'name' => 'Nome do Usuário 3',
        'description' => 'Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo',
        'created_at' => '11-21-2005',
        'total_videos' => 30,
        'subscribers' => 300
    ],
    [
        'icon' => 'default.jpg',
        'name' => 'Nome do Usuário 4',
        'description' => 'Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo',
        'created_at' => '11-21-2005',
        'total_videos' => 40,
        'subscribers' => 400
    ],
    [
        'icon' => 'default.jpg',
        'name' => 'Nome do Usuário 5',
        'description' => 'Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo',
        'created_at' => '11-21-2005',
        'total_videos' => 50,
        'subscribers' => 500
    ],
    [
        'icon' => 'default.jpg',
        'name' => 'Nome do Usuário 6',
        'description' => 'Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo',
        'created_at' => '11-21-2005',
        'total_videos' => 60,
        'subscribers' => 600
    ],
    [
        'icon' => 'default.jpg',
        'name' => 'Nome do Usuário 7',
        'description' => 'Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo',
        'created_at' => '11-21-2005',
        'total_videos' => 70,
        'subscribers' => 700
    ],
    [
        'icon' => 'default.jpg',
        'name' => 'Nome do Usuário 8',
        'description' => 'Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo',
        'created_at' => '11-21-2005',
        'total_videos' => 80,
        'subscribers' => 800
    ],
    [
        'icon' => 'default.jpg',
        'name' => 'Nome do Usuário 9',
        'description' => 'Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo',
        'created_at' => '11-21-2005',
        'total_videos' => 90,
        'subscribers' => 900
    ],
    [
        'icon' => 'default.jpg',
        'name' => 'Nome do Usuário 10',
        'description' => 'Olá! Meu nick é Moyo Shoyo e eu posto vídeos na Interwebs! Gosto de jogar League of Legends e outros jogos competitivos no geral, que tal dar uma olhadinha em outras plataformas? <br><br> Twitter e Twitch: @moyoshoyo',
        'created_at' => '11-21-2005',
        'total_videos' => 100,
        'subscribers' => 1000
    ]
];

@endphp

@extends('layouts.admin', ['title' => 'Usuários', 'page' => 'users'])

@section('main')
    
    <section class="main-section -reportedUsers">
        <h2>Usuários reportados</h2>

        @component('components.admin.adminTable')
            @foreach($users as $index => $user)

            <tr {!! $index > 4 ? 'style="display: none;"' : '' !!}>
                <td>
                    <img src="{{asset('assets/images/users/default.jpg')}}" alt="Ícone do Usuário">
                </td>

                <td>{{$user['name']}}</td>

                <td>{{$user['total_videos']}} vídeos</td>

                <td>{{$user['subscribers']}} inscritos</td>

                <td>

                    @include('components.button', [
                        'text' => 'Verificar', 
                        'classes' => 'reported-users-modal open-modal', 
                        'dataAttribute' => 'data-modal="reportedUsers"'
                    ])

                </td>
            </tr>

            @endforeach
        @endcomponent
    </section>

    @component('components.modal')
    
        @slot('modalName') reportedUsers @endslot

        @slot('title') Usuários reportados @endslot

        <div class="users-section">
            <h2>Denunciador</h2>

            <div class="user-icon-name">
                @include('components.userIcon', ['size' => '45px'])
    
                <h3>Moyo Shoyo (<a href="{{route('findUser', ['username' => '@moyoshoyo'])}}" target="_blank">@moyoshoyo</a>)</h3>
            </div>
    
            <div class="main-info-wrapper">
                <h4>Motivo:</h4>
    
                <p>Esse canal não me parece confiavel 🤬</p>
            </div>
        </div>

        <div class="users-section">
            <h2>Denunciado</h2>

            <div class="user-icon-name">
                @include('components.userIcon', ['size' => '45px'])
    
                <h3>oJulio Cesar (<a href="{{route('findUser', ['username' => '@ojuliocesar'])}}" target="_blank">@ojuliocesar</a>)</h3>
            </div>

            <div class="main-info-wrapper -description">
                <h4>Descrição do Canal:</h4>
    
                <p>
                    Olá! Meu nome é Moyo Shoyo e este é o meu primeiro vídeo, espero que gostem!<br><br>
    
                    Twitter: @moyoshoyo<br><br>
    
                    Discord: @moyoshoyo
                </p>
            </div>
        </div>

        <div class="buttons-wrapper">
            @include('components.button', ['text' => 'Banir', 'dataAttribute' => 'data-action="ban"'])

            @include('components.button', ['text' => 'Não banir', 'dataAttribute' => 'data-action="not-ban"'])
        </div>
        
    @endcomponent

@endsection

@section('scripts')

    <script src="{{asset('assets/js/components/admin/adminTable.js')}}"></script>

    <script src="{{asset('assets/js/components/modal.js')}}"></script>

    <script src="{{asset('assets/js/admin/users.js')}}"></script>

@endsection