@php

$videos = [
    [
        'title' => 'Yukirito e a jogada do Ninja',
        'thumbnail' => 'yukirito.png',
        'canalName' => 'Yukirito',
        'canalIcon' => 'yukirito.png',
        'description' => 'algumacoisa',
        'timeStamp' => '13 horas'
    ],
    [
        'title' => 'Naruto Shippuden Openings 1-20 (HD)',
        'thumbnail' => 'naruto.png',
        'canalName' => 'Crunchyroll',
        'canalIcon' => 'crunchyroll.png',
        'description' => 'algumacoisa',
        'timeStamp' => '4 anos'
    ],
    [
        'title' => 'a cada kill eu troco de MOUSE no HG',
        'thumbnail' => 'spop.png',
        'canalName' => 'Spop',
        'canalIcon' => 'spop.png',
        'description' => 'algumacoisa',
        'timeStamp' => '14 dias'
    ],
    [
        'title' => 'A LENDA DE FABINHO E SCARLAITI DE ORR',
        'thumbnail' => 'alan.png',
        'canalName' => 'Alanzoka',
        'canalIcon' => 'alan.png',
        'description' => 'algumacoisa',
        'timeStamp' => '5 anos'
    ],
    [
        'title' => "GTA COM 4 PESSOAS (no modo história '-')",
        'thumbnail' => 'saiko.png',
        'canalName' => 'Saiko Joga',
        'canalIcon' => 'saiko.png',
        'description' => 'algumacoisa',
        'timeStamp' => '3 anos'
    ],
    [
        'title' => 'Construindo o SISTEMA SOLAR no Minecraft - Em busca da casa automática #352',
        'thumbnail' => 'viniccius13.png',
        'canalName' => 'Viniccius13',
        'canalIcon' => 'viniccius13.png',
        'description' => 'algumacoisa',
        'timeStamp' => '5 dias'
    ]
];

@endphp

@extends('layouts.app', ['title' => 'Upload', 'page' => 'videos'])

@section('main')

    @include('components.button', [
        'text' => 'Publicar Vídeo',
        'classes' => 'open-modal',
        'modal' => 'upload'
    ])

    <ul class="videos-wrapper">
        @foreach($videos as $video)
            <li>
                <div class="important-infos-wrapper">
                    <img src="{{asset('assets/images/thumbnails/' . $video['thumbnail'])}}" alt="Thumbnail do Vídeo">

                    <div class="inputs-wrapper">
                        <input type="text" title="{{$video['title']}}" value="{{$video['title']}}" data-default="{{$video['title']}}">

                        <div class="actions-icon">
                            <i class="fa-solid fa-floppy-disk save"></i>
                            <i class="fa-solid fa-rotate-left reverse"></i>
                        </div>
                    </div>

                    <div class="inputs-wrapper">
                        <textarea name="description" id="description" data-default="{{$video['description']}}">{{$video['description']}}</textarea>

                        <div class="actions-icon">
                            <i class="fa-solid fa-floppy-disk save"></i>
                            <i class="fa-solid fa-rotate-left reverse"></i>
                        </div>
                    </div>

                </div>

                @component('components.button')

                    @slot('modal') videoInfo @endslot

                    @slot('text')
                        <i class="fa-solid fa-arrow-right"></i> Mais
                    @endslot

                    @slot('classes') open-modal @endslot
                @endcomponent
            </li>
        @endforeach
    </ul>

    @component('components.modal')
        @slot('modalName') videoInfo @endslot

        @slot('title') Informações do Vídeo @endslot

        <div class="infos-wrapper -like">
            <i class="fa-solid fa-thumbs-up"></i>

            <p>400.000</p>
        </div>

        <div class="infos-wrapper -views">
            <i class="fa-solid fa-eye"></i>

            <p>1.500.50</p>
        </div>

    @endcomponent

    {{-- Upload Modal --}}
    @component('components.modal')
        @slot('modalName') upload @endslot

        @slot('title') Upload de Vídeos @endslot

        
        <form method="POST" class="upload-video-wrapper">
            <div class="send-video-wrapper">
                <label class="labelImage" for="uploadVideo"><img src="{{asset('assets/images/icons/upload.png')}}"></label>
            
                <p>Clique e selecione os arquivos de vídeo para fazer o envio</p>
        
                <input class="input-send-video" style="display: none" type="file" accept="video/*" id="uploadVideo" name="uploadVideo">
            </div>
        
            <div class="final-info-wrapper">

                <div class="inputs-wrapper">
                    <label for="title-create">Título do Vídeo</label>
                    <input name="title-create" id="title-create" placeholder="Um Título legal" type="text">
                </div>

                <div style="margin-bottom: 10px;" class="inputs-wrapper">
                    <label for="description-create">Descrição do Vídeo</label>
                    <textarea name="description-create" id="descr data-default="Descrição Alguma coisa askasujdhja"iption-create" placeholder="Uma Descrição legal"></textarea>
                </div>

                <label class="select-thumbnail-element" for="thumbnail-create">
                    <img id="thumbnail-picture" src="{{asset('assets/images/icons/select_thumbnail.png')}}" alt="Thumbnail Image">
                </label>

                <input class="input-send-thumbnail" style="display: none;" type="file" accept="image/*" name="thumbnail-create" id="thumbnail-create">

                @include('components.button', [
                    'text' => 'Continuar'
                ])
        
            </div>

            <div class="email-message-sent">

                <i class="fa-solid fa-check"></i>

                <p>Muito bem! Seu post será analisado e você receberá um e-mail com o resultado. Até logo</p>

            </div>
        
            @include('components.loader')
        </form>

    @endcomponent

@endsection

@section('scripts')

    <script src="{{asset('assets/js/components/modal.js')}}"></script>

    <script src="{{asset('assets/js/pages/videos.js')}}"></script>

@endsection