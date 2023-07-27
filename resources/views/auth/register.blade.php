@extends('layouts.auth', ['title' => 'Criar Conta', 'page' => 'register'])

@section('main')

    @component('components.authForm')
        @slot('action') {{route('authRegister')}} @endslot

        @slot('title') Criar conta @endslot

        @slot('fields')
            <div class="inputs-wrapper">
                <input type="text" name="name" placeholder="Nome">

                @if ($errors->get('name'))
                    <p><i class="fa-solid fa-circle-exclamation"></i> {{$errors->get('name')[0]}}</p>
                @endif
            </div>

            <div class="inputs-wrapper">
                <input type="email" name="email" placeholder="E-mail">

                @if ($errors->get('email'))
                    <p><i class="fa-solid fa-circle-exclamation"></i> {{$errors->get('email')[0]}}</p>
                @endif
            </div>

            <div class="inputs-wrapper">
                <input type="password" name="password" placeholder="Senha">

                @if ($errors->get('password'))
                    <p><i class="fa-solid fa-circle-exclamation"></i> {{$errors->get('password')[0]}}</p>
                @endif
            </div>
        @endslot

        @slot('buttons')
            <button type="submit">Continuar</button>
            
            <a href="{{route('login')}}">Login</a>
        @endslot
    @endcomponent

@endsection