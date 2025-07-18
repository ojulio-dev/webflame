<ul class="sidebar">

    @foreach($this->loadMessages() as $message)

        <li wire:click="enterMessage">

            <div class="icon-wrapper">

                <img src="{{ asset('assets/images/users/' . $message['icon']) }}" alt="Ícone do Usuário">

                <span>{{ $message['pending_count'] }}</span>

            </div>

            <div class="infos-wrapper">

                <p>{{ $message['name'] }}</p>

                <small>{{ $message['last_message'] }}</small>

            </div>

        </li>

    @endforeach

</ul>
