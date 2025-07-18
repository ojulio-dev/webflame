<div>

    @component('components.modal')
        
        @slot('modalName', 'main-chat')

        @slot('title', 'Mensagens')

        <div class="messages-wrapper">

            <livewire:chat.sidebar />

            <livewire:chat.message-content />

        </div>

    @endcomponent
    
</div>