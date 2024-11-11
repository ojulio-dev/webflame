@extends('layouts.app', ['title' => 'Opening Tokyo Ghoul: Re season 3', 'page' => 'watch', 'search' => true])

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.12/plyr.css" integrity="sha512-DiRh+DVNccYmgFhKZTU84F7KVYu5baUooO4zEY5rD2CLDp2hRZ/OvAFKbtpgHEgE99bPh6p17j0I/AN0qXDSCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        header {
            margin-bottom: 0 !important;
        }

    </style>

@endsection

@section('main')
    @include('components.videoPlayer', ['dataPoster' => asset('assets/images/thumbnails/' . $dataVideo['thumbnail']), 'video' => $dataVideo['video']])

    <div class="title-wrapper">
        <h2>{{$dataVideo['title']}}</h2>

        <small>{{$dataVideo['views_count']}}</small>
    </div>

    <div class="feedback-and-subscribe">
        <div class="icons-wrapper" data-user-id="{{$globalDataUser['id']}}">

            @foreach($dataVideo['interactions'] as $interaction)

                <div data-interaction-id="{{$interaction['id']}}" class="{{$interaction['hasInteracted'] ? 'active' : ''}}">

                    <img src="{{asset('assets/images/interactions/' . $interaction['icon'])}}" alt="Ícone de Interação">

                    <small data-total-interaction="0">{{$interaction['count']}}</small>

                </div>

            @endforeach

        </div>


        <div class="canal-subscribe-wrapper">
            <a href="{{route('findUser', ['username' => $dataVideo['user']['username']])}}">
                @include('components.userIcon', [
                    'size' => '45px',
                    'source' => asset('assets/images/users/' . $dataVideo['user']['icon'])
                ])

                <div class="important-infos">
                    <p>{{$dataVideo['user']['name']}}</p>
                    <small id="total-user-subscribers">
                        <span>{{$dataVideo['user']['subscribers_count']}}</span>
                        
                        <span>{{$dataVideo['user']['subscribers_count'] == 1 ? 'inscrito' : 'inscritos'}}</span>
                    </small>
                </div>
            </a>

            @if ($dataVideo['user']['id'] != $globalDataUser['id'])

                @component('components.button')
                    
                    @slot('text') {!! $dataVideo['hasRegister'] ? '<i class="fa-solid fa-check"></i> Inscrito' : 'Inscrever-se' !!} @endslot

                    @slot('classes') {{$dataVideo['hasRegister'] ? '-subscriber' : ''}} @endslot

                    @slot('id') button-subscriber @endslot

                    @slot('attributes', [

                        'channel-id' => $dataVideo['user']['id'], 
                        'user-id' => $globalDataUser['id'],
                        'total-subscribers' => $dataVideo['user']['subscribers_count'] - $dataVideo['hasRegister'] ? 1 : 0

                    ])

                @endcomponent

                @component('components.actionsMenu')

                    <li id="open-report-video-modal"><i class="fa-solid fa-flag"></i> Reportar vídeo</li>
                    
                    <li><i class="fa-solid fa-comment"></i> Enviar mensagem</li>

                @endcomponent

            @else

            @component('components.button')
                @slot('text') <i class="fa-solid fa-gear"></i> @endslot
                @slot('link') {{route('profile')}} @endslot
            @endcomponent

            @endif
        </div>
    </div>

    <div class="additional-info-wrapper">
        <button class="button-element open-modal" data-modal="video-description">Descrição do Vídeo</button>

        <p>ou</p>

        <a href="{{route('findUser', ['username' => $dataVideo['user']['username']])}}" class="button-element">Mais vídeo de {{$dataVideo['user']['name']}}</a>
    </div>

    <div class="comment-element">
        <div class="send-comment">
                @include('components.userIcon', [
                    'size' => '45px',
                    'source' => asset('assets/images/users/' . $globalDataUser['icon'])
                ])

            <form class="input-wrapper">
                <input name="comment" id="comment" placeholder="Comente algo legal...">

                <button class="send-icon">
                    <img src="{{asset('assets/images/icons/send.png')}}" alt="Send Icon">
                </button>
            </form>
        </div>

        <div class="comments">
            @if (count($dataVideo['comments']))
                <ul>
                    @foreach($dataVideo['comments'] as $comment)
                        <li>
                            @include('components.userIcon', [
                                'redirect' => route('findUser', ['username' => $comment['user']['username']]),
                                'size' => '45px',
                                'source' => asset('assets/images/users/' . $comment['user']['icon'])
                            ])

                            <div class="important-infos">
                                <div>
                                    <a href="{{route('findUser', ['username' => $comment['user']['username']])}}">{{$comment['user']['name']}} {!! $dataVideo['user']['id'] == $comment['user']['id'] ? "<span>(Author)</span>" : "" !!}</a>

                                    <small>{{$comment['dataDiff']}}</small>
                                </div>

                                <p>{{$comment['comment']}}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>

            @else

                @include('components.smallMessage', ['slot' => 'Vish! Nenhum comentário encontrado. Que tal ser o primeiro!?', 'align' => 'center'])

            @endif
        </div>  
    </div>

    @component('components.modal')
        @slot('modalName', 'video-description')

        @slot('title', 'Descrição')

        <p>{!! nl2br($dataVideo['description']) !!}</p>

    @endcomponent

    @component('components.modal')
        
        @slot('modalName', 'report-video')

        @slot('title', 'Reportar vídeo')

        @include('components.input', [
            'type' => 'textarea',
            'identifier' => 'report-video-reason',
            'placeholder' => 'Qual o motivo do reporte?'
        ])

        @include('components.button', [
            'text' => 'Reportar', 
            'classes' => 'cleanHover',
            'width' => '100%',
            'id' => 'report-video-button',
            'attributes' => [
                'reported-user' => $dataVideo['user']['id'],
                'reporting-user' => Auth::user()['id'],
                'video-id' => $dataVideo['id']
            ]
        ])

    @endcomponent

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.12/plyr.min.js" integrity="sha512-KD7SjO7VUcKW975+6TGB/h/E//W8Pei+W9806myhzEwekQ9W82Ne5jUMa2JMVn+pqSICZDVnvckAhTUwfON+pA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('assets/js/components/modal.js')}}"></script>

    <script src="{{asset('assets/js/components/actionsMenu.js')}}"></script>

    <script src="{{asset('assets/js/components/videoPlayer.js')}}"></script>

   <script src="{{asset('assets/js/pages/watch.js')}}"></script>

@endsection