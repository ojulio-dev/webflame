@extends('layouts.app', ['title' => 'Perfil', 'page' => 'profile'])

@section('main')

    @include('components.title', ['slot' => 'Meu Perfil'])

    <div class="infos-wrapper">
        <div>
            @include('components.editImage', [
                'width' => '100%',
                'height' => '300px',
                'identifier' => 'userIcon',
                'src' => asset('assets/images/users/' . $user['icon']),
                'classes' => 'user-info-field'
            ])

            <small>Canal criado em {{$user['creation_date']}}</small>

            @include('components.button', ['text' => 'Meus vídeos', 'link' => route('videos')])
        </div>
    
        <form action="#" id="form-user-infos">
            <div class="fields-wrapper">
                <label for="name">Nome do Canal</label>

                <input type="text" class="user-info-field" name="name" id="name" placeholder="Sem nada" value="{{$user['name']}}">
            </div>

            <div class="fields-wrapper">
                <label for="username">Nome de Usuário</label>

                <input type="text" class="user-info-field" name="username" id="username" placeholder="Sem nada" value="{{$user['username']}}">
            </div>

            <div class="fields-wrapper">
                <label for="description">Sobre o Canal</label>

                <textarea class="user-info-field" name="description" id="description" placeholder="Sem nada">{{ $user['description'] }}</textarea>
            </div>

            <div class="action-buttons-wrapper">

                @component('components.button')
                    @slot('text') <i class="fa-solid fa-paintbrush"></i> @endslot
                    @slot('classes') save @endslot
                @endcomponent

                @component('components.button')
                    @slot('text') <i class="fa-solid fa-rotate-left"></i> @endslot
                    @slot('classes') discard @endslot
                @endcomponent
                
            </div>
        </form>
    </div>

@endsection

@section('scripts')

    <script src="{{asset('assets/js/components/editImage.js')}}"></script>

    <script src="{{asset('assets/js/pages/user/main.js')}}"></script>

@endsection