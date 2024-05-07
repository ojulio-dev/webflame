@extends('layouts.auth', ['title' => 'Entrar', 'page' => 'login'])

@section('main')

    @component('components.authForm')
        @slot('action') {{route('authLogin')}} @endslot

        @slot('title') Entrar @endslot

        @slot('fields')
            <div class="inputs-wrapper">
                <input type="email" name="email" id="email" placeholder="E-mail">

                @if ($errors->get('email'))
                    <p class="main-alert"><i class="fa-solid fa-circle-exclamation"></i> {{$errors->get('email')[0]}}</p>
                @endif
            </div>

            <div class="inputs-wrapper">
                <input type="password" name="password" id="password" placeholder="Senha">

                @if ($errors->get('password'))
                    <p class="main-alert"><i class="fa-solid fa-circle-exclamation"></i> {{$errors->get('password')[0]}}</p>
                @endif
            </div>

            @if ($errors->get('loginFailed'))

                <p class="main-alert"><i class="fa-solid fa-circle-exclamation"></i> {{$errors->get('loginFailed')[0]}}</p>

            @endif

        @endslot

        @slot('buttons')
            <button type="submit">Entrar</button>

            <a href="{{route('register')}}">Criar conta</a>

            <div class="signin-google">
                <p>Ou entre com o Google</p>
                <img src="{{asset('assets/images/icons/google.png')}}" alt="Ícone de Entrar com o Google">
            </div>
        @endslot
    @endcomponent

@endsection