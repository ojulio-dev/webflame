@extends('layouts.admin', ['title' => 'Vídeos', 'page' => 'videos'])

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.12/plyr.css" integrity="sha512-DiRh+DVNccYmgFhKZTU84F7KVYu5baUooO4zEY5rD2CLDp2hRZ/OvAFKbtpgHEgE99bPh6p17j0I/AN0qXDSCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('main')

    <section class="main-section -videosFilter">
        <h2>Aprovação de Vídeos</h2>

        @component('components.admin.adminTable', ['totalItems' => count($dataVideo['pending'])])
            @foreach($dataVideo['pending'] as $index => $video)

                <tr {!! $index > 4 ? 'style="display: none;"' : '' !!}>
                    <td>
                        <img src="{{asset('assets/images/thumbnails/' . $video['thumbnail'])}}" alt="Ícone do Usuário">
                    </td>
        
                    <td>{{$video['channel']}}</td>
        
                    <td>{{$video['title']}}</td>
        
                    <td> @include('components.button', ['text' => 'Validar', 'classes' => 'validate-button', 'attributes' => ['id' => $video['id']]]) </td>
                </tr>

            @endforeach
        @endcomponent
    </section>

    <section class="main-section -reportedVideos">
        <h2>Vídeos denunciados</h2>

        @component('components.admin.adminTable', ['totalItems' => count($dataVideo['reported'])])

            @foreach($dataVideo['reported'] as $index => $video)

                <tr {!! $index > 4 ? 'style="display: none;"' : '' !!}>
                    <td>
                        <img src="{{asset('assets/images/thumbnails\/') . $video->video['thumbnail']}}" alt="Thumbnail do Vídeo">
                    </td>
        
                    <td>{{$video->video->title}}</td>
        
                    <td> @include('components.button', ['text' => 'Avaliar', 'classes' => 'reported-videos-modal', 'attributes' => ['id' => $video['id']]]) </td>
                </tr>

            @endforeach

        @endcomponent
    </section>

    @component('components.admin.videoModal', ['attributes' => ['video-id' => '#']])

        @slot('name') validateVideos @endslot

        @slot('title') Validação de Vídeos <i class="fa-solid fa-check"></i> @endslot

        @include('components.videoPlayer', ['dataPoster' => asset('assets/images/thumbnails/default.png'), 'video' => '#'])
    
        <ul class="infos-wrapper">
            <li id="validate-info-channel">
                <h4>Canal:</h4> 

                <p><a href="#" target="_blank"></a></p>
            </li>

            <li id="validate-info-title">
                <h4>Título do Vídeo:</h4>

                <p></p>
            </li>
            
            <li class="description" id="validate-info-description">
                <h4>Descrição:</h4>
                
                <p></p>
            </li>
        </ul>

        <div class="buttons-wrapper">

            <button data-action="accept">Aceitar</button>

            <button data-action="refuse">Recusar</button>
            
        </div>
    @endcomponent

    @component('components.admin.videoModal', ['attributes' => ['reported-video' => '#']])

        @slot('name') reportedVideos @endslot

        @slot('title') Vídeos Denunciados <i class="fa-solid fa-triangle-exclamation"></i> @endslot

        @include('components.videoPlayer', ['dataPoster' => asset('assets/images/thumbnails/default.png'), 'video' => '#'])
    
        <ul class="infos-wrapper">
            <li id="reported-by">
                <h4>Denunciado por:</h4> 

                <p>#</p>
            </li>

            <li id="reported-reason">
                <h4>Motivo:</h4>

                <p class="main-textarea-input">#</p>
            </li>

            <li id="reported-user">
                <h4>Canal denunciado:</h4> 

                <p>#</p>
            </li>

            <li id="reported-title">
                <h4>Título do Vídeo:</h4>

                <p>#</p>
            </li>
            
            <li class="description" id="reported-description">
                <h4>Descrição:</h4>
                
                <p class="main-textarea-input">#</p>
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