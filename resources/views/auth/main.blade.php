@extends('layouts.auth', ['title' => 'Entrar', 'page' => 'login'])

@section('main')

    @component('components.authForm')
        @slot('title') Entrar @endslot

        @slot('fields')
            <input type="email" name="email" id="email" placeholder="E-mail">

            <input type="password" name="password" id="password" placeholder="Senha">
        @endslot

        @slot('buttons')
            <button type="button">Entrar</button>

            <a href="{{route('register')}}">Criar conta</a>

            <div class="signin-google">
                <p>Ou entre com o Google</p>
                <img src="{{asset('assets/images/icons/google.png')}}" alt="Ícone de Entrar com o Google">
            </div>
        @endslot
    @endcomponent

@endsection