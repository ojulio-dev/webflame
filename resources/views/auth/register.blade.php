@extends('layouts.auth', ['title' => 'Criar Conta', 'page' => 'register'])

@section('main')

    @component('components.authForm')
        @slot('title') Criar conta @endslot

        @slot('fields')
            <input type="text" name="name" placeholder="Nome">
                
            <input type="email" name="email" placeholder="E-mail">

            <input type="password" name="password" placeholder="Senha">
        @endslot

        @slot('buttons')
            <button type="button">Continuar</button>
            
            <a href="{{route('login')}}">Login</a>
        @endslot
    @endcomponent

@endsection