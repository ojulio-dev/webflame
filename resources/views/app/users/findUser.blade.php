@extends('layouts.app', ['title' => 'Moyo Shoyo', 'page' => 'findUser', 'search' => true])

@section('main')

    <div class="main-user-info">

        <div class="user-info-wrapper">
    
            @include('components.userIcon', [
                'size' => '80px',
                'source' => asset('assets/images/users/' . $dataUser['icon'])
            ])
    
            <div class="important-infos">
                <h4>{{$dataUser['name']}}</h4>
                <small id="total-user-subscribers">
                    <span>{{$dataUser['subscribers']}}</span>
                    
                    <span>{{$dataUser['subscribers'] == 1 ? 'inscrito' : 'inscritos'}}</span>
                </small>
            </div>
            
        </div>

        @if ($dataUser['id'] !== Auth::user()['id'])
            <div class="button-and-actions-menu">

                @component('components.button')
                    
                    @slot('text') {!! $dataUser['hasSubscriber'] ? '<i class="fa-solid fa-check"></i> Inscrito' : 'Inscrever-se' !!} @endslot

                    @slot('classes') {{$dataUser['hasSubscriber'] ? '-subscriber' : ''}} @endslot

                    @slot('id') button-subscriber @endslot

                    @slot('attributes', [

                        'channel-id' => $dataUser['id'], 
                        'user-id' => $globalDataUser['id'],
                        'total-subscribers' => $dataUser['subscribers'] - $dataUser['hasSubscriber'] ? 1 : 0

                    ])

                @endcomponent

                @component('components.actionsMenu')
                    <li id="open-report-user-modal"><i class="fa-solid fa-flag"></i> Reportar usuário</li>
                    <li><i class="fa-solid fa-comment"></i> Enviar mensagem</li>
                @endcomponent
            </div>
        @endif
    </div>

    <nav>
        <ul>
            <li data-section="videos" class="selected"><span>Vídeos</span></li>
            <li data-section="about"><span>Sobre</span></li>
        </ul>
    </nav>

    <section class="navigation-section">

        <div class="section-content -videos">
            @if (count($dataUser['videos']))

                @include('components.cardVideo', ['videos' => $dataUser['videos']])

            @else

                @include('components.smallMessage', ['slot' => 'O usuário ainda não publicou nenhum vídeo. Ele tá moscando'])

            @endif
        </div>

        <div class="section-content -about">
            <div class="about-wrapper">

                <div class="info-wrapper">
                    <h3>Descrição</h3>
    
                    <p>{!! $dataUser['description'] ? nl2br($dataUser['description']) : 'O usuário ainda não definiu uma descrição' !!}</p>
                </div>
    
                <div class="info-wrapper">
                    <h3>Outras informações</h3>
    
                    <p>Canal criado em {{$dataUser['year_created']}}</p>
    
                    <p>{{$dataUser['views']}}</p>
                </div>
            </div>
        </div>
        
    </section>

    @component('components.modal')
        
        @slot('title') Reportar canal @endslot

        @slot('modalName') report-user @endslot

        @include('components.input', ['type' => 'textarea', 'identifier' => 'report-user-reason', 'placeholder' => 'Qual o motivo do reporte?'])

        @include('components.button', ['text' => 'Reportar', 'width' => '100%', 'id' => 'report-user-button', 'classes' => 'cleanHover', 'attributes' => ['reporting-user' => Auth::user()['id'], 'reported-user' => $dataUser['id']]])

    @endcomponent


@endsection

@section('scripts')

    <script src="{{asset('assets/js/components/modal.js')}}"></script>

    <script src="{{asset('assets/js/pages/user/findUser.js')}}"></script>

    <script src="{{asset('assets/js/components/cardVideo.js')}}"></script>

    <script src="{{asset('assets/js/components/actionsMenu.js')}}"></script>

@endsection