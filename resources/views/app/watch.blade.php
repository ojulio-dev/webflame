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
    @include('components.videoPlayer', ['dataPoster' => 'https://i.ytimg.com/vi/ZsQnAuh3tZU/hq720.jpg?sqp=-oaymwEcCOgCEMoBSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLAO4GzAO2QsgQf78zkfm3pG3E73-g'])

    <div class="title-wrapper">
        <h2>Opening Tokyo Ghoul: Re season 3</h2>

        <small>53 visualizações</small>
    </div>

    <div class="feedback-and-subscribe">
        <div class="icons-wrapper">
            <img src="{{asset('assets/images/icons/emojis/love.png')}}" alt="">
            <img src="{{asset('assets/images/icons/emojis/laugh.png')}}" alt="">
            <img src="{{asset('assets/images/icons/emojis/cry.png')}}" alt="">
            <img src="{{asset('assets/images/icons/emojis/rage.png')}}" alt="">
        </div>


        <div class="canal-subscribe-wrapper">
            <a href="{{route('profile')}}">
                @include('components.userIcon', [
                    'size' => '45px'
                ])

                <div class="important-infos">
                    <p>Moyo Shoyo</p>
                    <small>50 inscritos</small>
                </div>
            </a>

            @include('components.button', ['text' => 'Increver-se', 'classes' => 'subscriber'])
        </div>
    </div>

    <div class="additional-info-wrapper">
        <button class="button-element open-modal" data-modal="video-description">Descrição do Vídeo</button>

        <p>ou</p>

        <a href="{{route('findUser', ['username' => '@moyoshoyo'])}}" class="button-element">Mais vídeo de Moyo Shoyo</a>
    </div>

    <div class="comment-element">
        <div class="send-comment">
                @include('components.userIcon', [
                    'redirect' => route('profile'),
                    'size' => '45px'
                ])

            <div class="input-wrapper">
                <input name="comment" id="comment" placeholder="Comente algo legal...">

                <div class="send-icon">
                    <img src="{{asset('assets/images/icons/send.png')}}" alt="">
                </div>
            </div>
        </div>

        <ul>
            <li>
                @include('components.userIcon', [
                    'redirect' => route('profile'),
                    'size' => '45px'
                ])

                <div class="important-infos">
                    <div>
                        <a href="{{route('profile')}}">Moyo Shoyo</a>

                        <small>Há 2 anos</small>
                    </div>

                    <p>Cara essa abertura é uma das melhores sério</p>
                </div>
            </li>

            <li>
                @include('components.userIcon', [
                    'redirect' => route('profile'),
                    'size' => '45px',
                    'source' => 'https://i.pinimg.com/736x/80/a6/61/80a661624920c01310d42d60834354ef.jpg'
                ])

                <div class="important-infos">
                    <div>
                        <a href="{{route('profile')}}">Moyo Shoyo</a>

                        <small>Há 2 anos</small>
                    </div>

                    <p>Já eu não tô achando muito daora não</p>
                </div>
            </li>

            <li>
                @include('components.userIcon', [
                    'redirect' => route('profile'),
                    'size' => '45px',
                    'source' => 'https://pm1.aminoapps.com/7846/c29aa598cbbc46b4ffbd23e447046fb6ee195b70r1-300-300v2_00.jpg'
                ])

                <div class="important-infos">
                    <div>
                        <a href="{{route('profile')}}">Moyo Shoyo</a>

                        <small>Há 2 anos</small>
                    </div>

                    <p>Mas eu acho daora pô</p>
                </div>
            </li>

            <li>
                @include('components.userIcon', [
                    'redirect' => route('profile'),
                    'size' => '45px',
                    'source' => 'https://media.tenor.com/DDOLg4aNjTwAAAAd/anime-anime-boy.gif'
                ])

                <div class="important-infos">
                    <div>
                        <a href="{{route('profile')}}">Moyo Shoyo</a>

                        <small>Há 2 anos</small>
                    </div>

                    <p>Os dois podem fazer silêncio? Grato.</p>
                </div>
            </li>
        </ul>
    </div>

    @component('components.modal')
        @slot('modalName', 'video-description')

        @slot('title', 'Descrição')

        <p>Olá! Meu nome é Moyo Shoyo e este é o meu primeiro vídeo, espero que gostem! <br><br> Twitter: @moyoshoyo <br><br> Discord: @moyoshoyo</p>

    @endcomponent

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.12/plyr.min.js" integrity="sha512-KD7SjO7VUcKW975+6TGB/h/E//W8Pei+W9806myhzEwekQ9W82Ne5jUMa2JMVn+pqSICZDVnvckAhTUwfON+pA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('assets/js/components/modal.js')}}"></script>

   <script src="{{asset('assets/js/pages/watch.js')}}"></script>

@endsection