@extends('layouts.app', ['title' => 'Perfil', 'page' => 'profile'])

@section('main')

    @include('components.title', ['slot' => 'Meu Perfil'])

    <div class="infos-wrapper">
        <div>
            @include('components.editImage', [
                'width' => '100%',
                'height' => '300px',
                'identifier' => 'userIcon'
            ])

            <small>Canal criado em 12 de maio de 2023</small>

            @include('components.button', ['text' => 'Meus vídeos', 'link' => route('videos')])
        </div>
    
        <form action="#">
            <div class="fields-wrapper">
                <label for="name">Nome do Canal</label>

                <input type="text" name="name" id="name" value="Moyo Shoyo">
            </div>

            <div class="fields-wrapper">
                <label for="username">Nome de Usuário</label>

                <input type="text" name="username" id="username" value="moyoshoyo23">
            </div>

            <div class="fields-wrapper">
                <label for="description">Sobre o Canal</label>

                <textarea name="description" id="description">Olá! meu nick é Moyo Shoyo e comecei a postar videos para o Youtube! Espero que goste <br> Twitter: @moyoshoyo <br> Discord: Moyo Shoyo#4262</textarea>
            </div>
        </form>
    </div>

@endsection

@section('scripts')

    <script src="{{asset('assets/js/components/editImage.js')}}"></script>

@endsection