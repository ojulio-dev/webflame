@php
    
    $videos = [
        [
            "userIcon" => "default.jpg",
            "channel" => "Moyo Shoyo",
            "title" => "Título do Vídeo 1"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 2",
            "title" => "Título do Vídeo 2"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 3",
            "title" => "Título do Vídeo 3"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 4",
            "title" => "Título do Vídeo 4"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 5",
            "title" => "Título do Vídeo 5"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 6",
            "title" => "Título do Vídeo 6"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 7",
            "title" => "Título do Vídeo 7"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 8",
            "title" => "Título do Vídeo 8"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 9",
            "title" => "Título do Vídeo 9"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 10",
            "title" => "Título do Vídeo 10"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Moyo Shoyo",
            "title" => "Título do Vídeo 1"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 2",
            "title" => "Título do Vídeo 2"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 3",
            "title" => "Título do Vídeo 3"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 4",
            "title" => "Título do Vídeo 4"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 5",
            "title" => "Título do Vídeo 5"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 6",
            "title" => "Título do Vídeo 6"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 7",
            "title" => "Título do Vídeo 7"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 8",
            "title" => "Título do Vídeo 8"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 9",
            "title" => "Título do Vídeo 9"
        ],
        [
            "userIcon" => "default.jpg",
            "channel" => "Canal 10",
            "title" => "Título do Vídeo 10"
        ]
    ];

@endphp 

@extends('layouts.admin', ['title' => 'Vídeos', 'page' => 'videos'])

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.12/plyr.css" integrity="sha512-DiRh+DVNccYmgFhKZTU84F7KVYu5baUooO4zEY5rD2CLDp2hRZ/OvAFKbtpgHEgE99bPh6p17j0I/AN0qXDSCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('main')

    <section class="main-section -videosFilter">
        <h2>Aprovação de Vídeos</h2>

        @component('components.admin.adminTable')
            @foreach($videos as $index => $video)

                <tr {!! $index > 4 ? 'style="display: none;"' : '' !!}>
                    <td>
                        <img src="{{asset('assets/images/users\/') . $video['userIcon']}}" alt="Ícone do Usuário">
                    </td>
        
                    <td>{{$video['channel']}}</td>
        
                    <td>{{$video['title']}}</td>
        
                    <td> @include('components.button', ['text' => 'Validar', 'classes' => 'validate-button']) </td>
                </tr>

            @endforeach
        @endcomponent
    </section>

    <section class="main-section -reportedVideos">
        <h2>Vídeos denunciados</h2>

        @component('components.admin.adminTable')
            @foreach($videos as $index => $video)

                <tr {!! $index > 4 ? 'style="display: none;"' : '' !!}>
                    <td>
                        <img src="{{asset('assets/images/users\/') . $video['userIcon']}}" alt="Ícone do Usuário">
                    </td>
        
                    <td>{{$video['channel']}}</td>
        
                    <td>{{$video['title']}}</td>
        
                    <td> @include('components.button', ['text' => 'Avaliar', 'classes' => 'reported-videos-modal']) </td>
                </tr>

            @endforeach
        @endcomponent
    </section>

    @component('components.admin.videoModal')

        @slot('name') validateVideos @endslot

        @slot('title') Validação de Vídeos <i class="fa-solid fa-check"></i> @endslot

        @include('components.videoPlayer', ['dataPoster' => 'https://pbs.twimg.com/media/DvXIEK0WwAAVdLc.png'])


    
        <ul class="infos-wrapper">
            <li>
                <h4>Canal:</h4> 

                <p><a href="{{route('findUser', ['username' => '@moyoshoyo'])}}" target="_blank">@moyoshoyo</a></p>
            </li>

            <li>
                <h4>Título do Vídeo:</h4>

                <p>Um título de Vídeo legal :D</p>
            </li>
            
            <li class="description">
                <h4>Descrição:</h4>
                
                <p>obrigado por assistir :D <br><br> Twitter e Discord: @moyoshoyo</p>
            </li>
        </ul>

        <div class="buttons-wrapper">

            <button data-action="accept">Aceitar</button>

            <button data-action="refuse">Recusar</button>
            
        </div>
    @endcomponent

    @component('components.admin.videoModal')

        @slot('name') reportedVideos @endslot

        @slot('title') Vídeos Denunciados <i class="fa-solid fa-triangle-exclamation"></i> @endslot

        @include('components.videoPlayer', ['dataPoster' => 'https://pbs.twimg.com/media/DvXIEK0WwAAVdLc.png'])
    
        <ul class="infos-wrapper">
            <li>
                <h4>Denunciado por:</h4> 

                <p><a href="{{route('findUser', ['username' => '@moyoshoyo'])}}" target="_blank">@moyoshoyo</a></p>
            </li>

            <li>
                <h4>Motivo:</h4>

                <p>Esse vídeo não me parece confiavel 🤬</p>
            </li>

            <li>
                <h4>Canal denunciado:</h4> 

                <p><a href="{{route('findUser', ['username' => '@moyoshoyo'])}}" target="_blank">@ojuliocesar</a></p>
            </li>

            <li>
                <h4>Título do Vídeo:</h4>

                <p>Um título de Vídeo legal :D</p>
            </li>
            
            <li class="description">
                <h4>Descrição:</h4>
                
                <p>obrigado por assistir :D <br><br> Twitter e Discord: @moyoshoyo</p>
            </li>
        </ul>

        <div class="buttons-wrapper">

            <button data-action="remove">Remover vídeo</button>

            <button data-action="not-remove">Não remover</button>
            
        </div>
    @endcomponent

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.12/plyr.min.js" integrity="sha512-KD7SjO7VUcKW975+6TGB/h/E//W8Pei+W9806myhzEwekQ9W82Ne5jUMa2JMVn+pqSICZDVnvckAhTUwfON+pA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('assets/js/components/admin/adminTable.js')}}"></script>

    <script src="{{asset('assets/js/admin/videos.js')}}"></script>

@endsection