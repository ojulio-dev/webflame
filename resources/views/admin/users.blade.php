@extends('layouts.admin', ['title' => 'Usuários', 'page' => 'users'])

@section('main')
    
    <section class="main-section -reportedUsers">
        <h2>Usuários reportados</h2>

        @component('components.admin.adminTable', ['totalItems' => count($users)])
            @foreach($users as $index => $user)

            <tr {!! $index > 4 ? 'style="display: none;"' : '' !!}>
                <td>
                    <img src="{{asset('assets/images/users/' . $user->reportedUser['icon'])}}" alt="Ícone do Usuário">
                </td>

                <td>{{$user->reportedUser['name']}}</td>

                <td>{{count($user->reportedUser->videos)}} vídeos</td>

                <td>{{count($user->reportedUser->subscribers)}} inscritos</td>

                <td>

                    @include('components.button', [
                        'text' => 'Verificar', 
                        'classes' => 'reported-users-modal', 
                        'attributes' => ['modal' => 'reportedUsers', 'id' => $user['id']]
                    ])

                </td>
            </tr>

            @endforeach
        @endcomponent
    </section>

    @component('components.modal')
    
        @slot('modalName') reportedUsers @endslot

        @slot('title') Usuários reportados @endslot

        @slot('attributes', ['reported-id' => '#'])

        <div class="users-section -reportingUser">
            <h2>Denunciador</h2>

            <div class="user-icon-name">
                @include('components.userIcon', ['size' => '45px', 'source' => '1.png'])
    
                <h3>Moyo Shoyo (<a href="{{route('findUser', ['username' => '@moyoshoyo'])}}" target="_blank">@moyoshoyo</a>)</h3>
            </div>
    
            <div class="main-info-wrapper">
                <h4>Motivo:</h4>
    
                <p>Esse canal não me parece confiavel 🤬</p>
            </div>
        </div>

        <div class="users-section -reportedUser">
            <h2>Denunciado</h2>

            <div class="user-icon-name">
                @include('components.userIcon', ['size' => '45px', 'source' => '1.png'])
    
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
            @include('components.button', ['text' => 'Banir', 'attributes' => ['action' => 'ban', 'reported-id' => '#']])

            @include('components.button', ['text' => 'Não banir', 'attributes' => ['action' => 'not-ban', 'reported-id' => '#']])
        </div>
        
    @endcomponent

@endsection

@section('scripts')

    <script src="{{asset('assets/js/components/admin/adminTable.js')}}"></script>

    <script src="{{asset('assets/js/components/modal.js')}}"></script>

    <script src="{{asset('assets/js/admin/users.js')}}"></script>

@endsection