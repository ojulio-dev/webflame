<ul class="sidebar" x-data="{ selected: null }">

    @foreach($this->loadMessages() as $index => $message)

        <li
            :class="{ '-selected': selected === {{ $index }} }"

            @click="
                selected = {{ $index }};
                $dispatch('chat::enterMessage', {
                    selectedUser: '{{ $message->username }}'
                })
            "
        >

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
