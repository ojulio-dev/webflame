@extends('layouts.app', ['title' => 'Entrar', 'content' => 'auth', 'hideHeader' => true])

@section('main')

    <div class="form-wrapper">
        <h1>WebFlame</h1>

        <p>A melhor rede social de compartilhamento de vídeos da minha cidade!</p>

        <h3>Entrar</h3>

        <form method="POST">
            <input type="email" name="email" id="email" placeholder="E-Mail">

            <input type="password" name="password" id="password" placeholder="Senha">

            <div class="buttons-wrapper">
                <button type="button">Entrar</button>
                <button type="button">Criar conta</button>
            </div>
        </form>
    </div>

@endsection