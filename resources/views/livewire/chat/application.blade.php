<div>
    @component('components.modal')
        @slot('modalName', 'main-chat')

        @slot('title', 'Mensagens')

        <div id="main-chat-component">

            <livewire:chat.sidebar />
            <livewire:chat.message-content />

        </div>
    @endcomponent
</div>