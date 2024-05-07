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

    <div class="videos-wrapper">
        @if (count($videos))

            <table>
                @foreach($videos as $video)

                    <tr data-video="{{$video->id}}">
                        <td class="thumbnail-wrapper">
                            <a href="{{route('watch', ['video' => $video['id']])}}">
                                <img src="{{asset('assets/images/thumbnails/' . $video['thumbnail'])}}" alt="Thumbnail">
                            </a>
                        </td>

                        <td class="title">
                            <p title="{{$video->title}}">{{$video->title}}</p>
                        </td>

                        <td>{{$video->views_count}}</td>

                        <td class="status -{{$video->status['name']}}">{{$video->status['name']}}</td>

                        <td>
                            @include('components.button', ['text' => 'Mais informações', 'classes' => 'more-info-video', 'modal' => 'editVideo'])
                        </td>
                    </tr>
                @endforeach
            </table>

        @else

            @include('components.smallMessage', ['slot' => 'Pô, nos contaram que tu ainda não publicou nenhum vídeo, tá moscando? Clica no botão ae vei'])

        @endif
    </div>

    {{-- Edit video Modal --}}
    @component('components.modal')
        @slot('modalName') editVideo @endslot

        @slot('title') Mais informações @endslot

        
        <section class="infos-wrapper">
            <h2>Editar informações</h2>

            <div class="editing-element">
                @include('components.editImage', [
                    'width' => '100%',
                    'height' => '290px',
                    'identifier' => 'editing-thumbnail'
                ])
    
                <form class="inputs-wrapper" action="#">
                    
                    @component('components.input')
                        @slot('identifier') editing-title @endslot

                        @slot('title') Título @endslot

                        @slot('type') input @endslot

                        @slot('inputType') text @endslot

                        @slot('placeholder') Um título feliz @endslot
                        
                    @endcomponent
    
                    @component('components.input')
                    
                        @slot('identifier') editing-description @endslot

                        @slot('title') Descrição @endslot

                        @slot('type') textarea @endslot

                        @slot('placeholder') Uma descrição legal @endslot

                    @endcomponent
    
                </form>

                <div class="actions-button-wrapper">

                    @component('components.button')

                        @slot('text') <i class="fa-solid fa-paintbrush"></i> @endslot
                        @slot('classes') save @endslot

                    @endcomponent

                    @component('components.button')

                        @slot('text') <i class="fa-solid fa-rotate-left"></i> @endslot
                        @slot('classes') discart @endslot

                    @endcomponent

                </div>
            </div>
        </section>

        <section class="interactions-wrapper">
            <h2>Interações</h2>

            <ul class="interactions-element">
                @foreach ($interactions as $interaction)
                    
                <li>
                    <p>0</p>
                    <img src="{{asset('assets/images/interactions/' . $interaction['icon'])}}">
                </li>

                @endforeach
            </ul>
        </section>

        <section class="actions-wrapper">
            <h2>Ações</h2>

            <div class="actions-element">

                @component('components.button')

                    @slot('text') Privar vídeo <i class="fa-solid fa-lock"></i> @endslot

                    @slot('id') deprive-video-button @endslot
                    
                @endcomponent

                @component('components.button')

                    @slot('text') Remover vídeo <i class="fa-solid fa-trash-can"></i> @endslot
                    
                    @slot('id') delete-video-button @endslot

                @endcomponent

            </div>
        </section>

    @endcomponent

    {{-- Upload Modal --}}
    @component('components.modal')
        @slot('modalName') upload @endslot

        @slot('title') Upload de Vídeos @endslot

        @slot('alert') *Aceitamos vídeos com no máximo 1GB @endslot

        @slot('progress') true @endslot

        <form method="POST" class="upload-video-wrapper" enctype="multipart/form-data">
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
                    'text' => 'Continuar',
                    'type' => 'submit',
                    'id' => 'send-video-button'
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