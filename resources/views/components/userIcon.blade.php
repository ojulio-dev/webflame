@if (isset($redirect))

    <a href="{{$redirect}}">
        <img 
            class="main-user-icon" 
            src="{{$source ?? asset('assets/images/users/default.jpg')}}"
            alt="Ícone de Usuário"
            style="width: {{$size}}; height: {{$size}}"
        >
    </a>

@else

    <img 
        class="main-user-icon" 
        src="{{$source}}"
        alt="Ícone de Usuário" 
        style="width: {{$size}}; height: {{$size}}"
    >

@endif