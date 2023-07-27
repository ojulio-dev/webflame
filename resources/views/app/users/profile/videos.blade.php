@php

$videos = [
    [
        'title' => 'Yukirito e a jogada do Ninja',
        'thumbnail' => 'yukirito.png',
        'canalName' => 'Yukirito',
        'canalIcon' => 'yukirito.png',
        'description' => 'algumacoisa',
        'timeStamp' => '13 horas',
        'viewing_status' => 0
    ],
    [
        'title' => 'Naruto Shippuden Openings 1-20 (HD)',
        'thumbnail' => 'naruto.png',
        'canalName' => 'Crunchyroll',
        'canalIcon' => 'crunchyroll.png',
        'description' => 'algumacoisa',
        'timeStamp' => '4 anos',
        'viewing_status' => 1
    ],
    [
        'title' => 'a cada kill eu troco de MOUSE no HG',
        'thumbnail' => 'spop.png',
        'canalName' => 'Spop',
        'canalIcon' => 'spop.png',
        'description' => 'algumacoisa',
        'timeStamp' => '14 dias',
        'viewing_status' => 1
    ],
    [
        'title' => 'A LENDA DE FABINHO E SCARLAITI DE ORR',
        'thumbnail' => 'alan.png',
        'canalName' => 'Alanzoka',
        'canalIcon' => 'alan.png',
        'description' => 'algumacoisa',
        'timeStamp' => '5 anos',
        'viewing_status' => 0
    ],
    [
        'title' => "GTA COM 4 PESSOAS (no modo história '-')",
        'thumbnail' => 'saiko.png',
        'canalName' => 'Saiko Joga',
        'canalIcon' => 'saiko.png',
        'description' => 'algumacoisa',
        'timeStamp' => '3 anos',
        'viewing_status' => 1
    ],
    [
        'title' => 'Construindo o SISTEMA SOLAR no Minecraft - Em busca da casa automática #352',
        'thumbnail' => 'viniccius13.png',
        'canalName' => 'Viniccius13',
        'canalIcon' => 'viniccius13.png',
        'description' => 'algumacoisa',
        'timeStamp' => '5 dias',
        'viewing_status' => 0
    ]
];

@endphp

@extends('layouts.app', ['title' => 'Meus vídeos', 'page' => 'videos'])

@section('main')

    <div class="upload-video-element">
        <p>Faça a magia acontecer</p>

        <img src="{{asset('assets/images/icons/animated_arrow.gif')}}" alt="Flecha que está apontando para o botão">

        @include('components.button', [
            'text' => 'Publicar Vídeo',
            'classes' => 'open-modal',
            'modal' => 'upload'
        ])
    </div>

    <h2>Vídeos</h2>
    <table class="videos-wrapper">
        @foreach($videos as $video)
            <tr>
                <td class="thumbnail-wrapper">
                    <a href="{{route('watch')}}">
                        <img src="{{asset('assets/images/thumbnails/' . $video['thumbnail'])}}" alt="Thumbnail">
                    </a>
                </td>

                <td>
                    <div class="inputs-wrapper">
                        <input type="text" title="{{$video['title']}}" value="{{$video['title']}}" data-default="{{$video['title']}}">

                        <div class="actions-icon">
                            <i class="fa-solid fa-floppy-disk save"></i>
                            <i class="fa-solid fa-rotate-left reverse"></i>
                        </div>
                    </div>
                </td>

                <td>103 visualizações</td>

                <td class="status -{{$video['viewing_status'] ? 'publish' : 'private'}}">{{$video['viewing_status'] ? 'Público' : 'Privado'}}</td>

                <td>
                    @include('components.button', ['text' => 'Mais informações', 'classes' => 'open-modal', 'modal' => 'editVideo'])
                </td>
            </tr>
        @endforeach
    </table>

    @component('components.modal')
        @slot('modalName') editVideo @endslot

        @slot('title') Mais informações @endslot

        
        <section>
            <h2>Editar informações</h2>

            <div class="editing-element">
                @include('components.editImage', [
                    'width' => '100%',
                    'height' => '290px',
                    'identifier' => 'editing-thumbnail',
                    'src' => 'https://fiverr-res.cloudinary.com/t_main1,q_auto,f_auto/gigs/312692089/original/7820d34cdbd72359a23e6f1bb0f67af43b70b0b4.png'
                ])
    
                <div class="inputs-wrapper">
                    
                    @component('components.input')
                        @slot('identifier') editing-title @endslot

                        @slot('title') Título @endslot

                        @slot('type') input @endslot

                        @slot('inputType') text @endslot

                        @slot('placeholder') Um título feliz @endslot

                        @slot('value') Como ganhar dinheiro do jeito certo no youtube! @endslot
                        
                    @endcomponent
    
                    @component('components.input')
                    
                        @slot('identifier') editing-description @endslot

                        @slot('title') Descrição @endslot

                        @slot('type') textarea @endslot

                        @slot('placeholder') Uma descrição legal @endslot

                        @slot('value') Deixa o like pls @endslot

                    @endcomponent
    
                </div>

                <div class="buttons-wrapper">
                    @component('components.button')
                        @slot('text') <i class="fa-solid fa-check"></i> @endslot
                        @slot('classes') cleanHover @endslot
                    @endcomponent

                    @component('components.button')
                        @slot('text') <i class="fa-solid fa-rotate-left"></i> @endslot
                        @slot('classes') cleanHover @endslot
                    @endcomponent
                </div>
            </div>
        </section>

        <section class="interactions-wrapper">
            <h2>Interações</h2>

            <ul class="interactions-element">
                <li>
                    <p>32</p>
                    <img src="{{asset('assets/images/icons/emojis/love.png')}}">
                </li>

                <li>
                    <p>32</p>
                    <img src="{{asset('assets/images/icons/emojis/laugh.png')}}">
                </li>

                <li>
                    <p>32</p>
                    <img src="{{asset('assets/images/icons/emojis/cry.png')}}">
                </li>

                <li>
                    <p>32</p>
                    <img src="{{asset('assets/images/icons/emojis/rage.png')}}">
                </li>
            </ul>
        </section>

        <section>
            <h2>Ações</h2>

            <div class="actions-element">

                @include('components.button', ['text' => 'Privar vídeo', 'classes' => 'cleanHover'])

                @include('components.button', ['text' => 'Remover vídeo', 'classes' => 'cleanHover'])

            </div>
        </section>

    @endcomponent

    {{-- Upload Modal --}}
    @component('components.modal')
        @slot('modalName') upload @endslot

        @slot('title') Upload de Vídeos @endslot

        @slot('progress') true @endslot

        <form method="POST" class="upload-video-wrapper">
            <div class="send-video-wrapper">
                <label class="labelImage" for="uploadVideo"><img src="{{asset('assets/images/icons/upload.png')}}"></label>
            
                <p>Clique e selecione o arquivo do vídeo para fazer o envio</p>
        
                <input class="input-send-video" style="display: none" type="file" accept="video/*" id="uploadVideo" name="uploadVideo">
            </div>
        
            <div class="final-info-wrapper">

                @component('components.input')
                    
                    @slot('identifier') title-create @endslot

                    @slot('title') Título do Vídeo @endslot

                    @slot('type') input @endslot

                    @slot('inputType') text @endslot

                    @slot('placeholder') Um título feliz @endslot

                @endcomponent

                @component('components.input')
                    
                    @slot('identifier') description-create @endslot

                    @slot('title') Descrição do Vídeo @endslot

                    @slot('type') textarea @endslot

                    @slot('placeholder') Uma descrição legal @endslot

                @endcomponent

                <label class="select-thumbnail-element" for="thumbnail-create">
                    <img id="thumbnail-picture" src="{{asset('assets/images/icons/select_thumbnail.png')}}" alt="Thumbnail Image">
                </label>

                <input class="input-send-thumbnail" style="display: none;" type="file" accept="image/*" name="thumbnail-create" id="thumbnail-create">

                @include('components.button', [
                    'text' => 'Continuar'
                ])
        
            </div>

            <div class="email-message-sent">

                <img src="{{asset('assets/images/icons/nyan_cat.gif')}}" alt="Animação de Verificado" width="100">

                <p>Muito bem! Seu vídeo será analisado e você receberá um e-mail com o resultado. Fica ligado, belê?</p>

            </div>
        
            @include('components.loader')
        </form>

    @endcomponent

@endsection

@section('scripts')

    <script src="{{asset('assets/js/components/modal.js')}}"></script>

    <script src="{{asset('assets/js/components/editImage.js')}}"></script>

    <script src="{{asset('assets/js/pages/videos.js')}}"></script>

@endsection