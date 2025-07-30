<ul class="sidebar" x-data="{ selected: null }">
    @foreach ($this->loadUsers as $index => $user)
    
        <li :class="{ '-selected': {{ $selectedUser }} === {{ $index }} }"
            wire:click="selectUser('{{ $user->username }}', {{ $index }})"
        >
            <div class="icon-wrapper">

                <img src="{{ asset('assets/images/users/' . $user['icon']) }}" alt="Ícone do Usuário">

                @if ($user['pending_count'])
                    <span>{{ $user['pending_count'] }}</span>
                @endif

            </div>

            <div class="infos-wrapper">

                <p>{{ $user['name'] }}</p>

                <small>{{ $user['last_message'] }}</small>

            </div>
        </li>
        
    @endforeach
</ul>
