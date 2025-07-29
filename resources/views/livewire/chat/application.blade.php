<div id="main-chat-component">
    @if ($this->followings())

        <livewire:chat.sidebar />
        <livewire:chat.message-content />

    @else

        <small class="not-found">Infelizmente você ainda não segue ninguém... 😔 Vai dar uma explorada, pô 🔥</small>

    @endif
</div>