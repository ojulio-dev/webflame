<div class="message-content">

    @if ( $this->contextUser && $this->contextMessages )
        <div class="header">
            <div class="icon-wrapper">

                @include('components.userIcon', [
                    'size' => '60px',
                    'source' => asset('assets/images/users/' . $this->contextUser->icon)
                ])
                
            </div>

            <div class="infos-wrapper">
                <a href="{{ route('findUser', $this->contextUser->username) }}" target="_BLANK">
                    <h4>{{ $this->contextUser->name }}</h4>
                </a>
            </div>
        </div>

        <ul
            class="messages-wrapper"
            x-data="{
                scrollToBottom() {
                    if ($refs['messages-wrapper']) {
                        $refs['messages-wrapper'].scrollTop = $refs['messages-wrapper'].scrollHeight;
                    }
                },
                init() {
                    this.scrollToBottom();
                    window.addEventListener('updated-messages', () => {
                        this.$nextTick(() => this.scrollToBottom());
                    });
                }
            }"
            x-init="init"
            x-ref="messages-wrapper"
        >
            @foreach($this->contextMessages as $message)

                <li class="{{ $message->is_author ? '-sent' : '-receiver' }}">
                    @include('components.userIcon', [
                        'size' => '35px',
                        'source' => asset('assets/images/users/' . $message->sender->icon)
                    ])

                    <div class="message-wrapper">
                        <p>{{ $message->message }}</p>

                        <small>
                            @if ( ! is_null($message->viewed_at) )
                                <span>
                                    viewed <i class="fa-solid fa-check"></i>
                                </span>
                            @endif
                            
                            {{ $message->created_at->format('H:i') }}
                        </small>
                    </div>
                </li>

            @endforeach
        </ul>

        <div class="send-message-wrapper">

            <div class="send-comment">
                @include('components.userIcon', [
                    'size' => '45px',
                    'source' => asset('assets/images/users/' . $this->authUser->icon)
                ])

            <form 
                class="input-wrapper"
                wire:submit.prevent="sendMessage"
            >
                <input wire:model="message" name="comment" id="comment" placeholder="Envia algo legal...">

                <button class="send-icon">
                    <img src="{{asset('assets/images/icons/send.png')}}" alt="Send Icon">
                </button>
            </form>
        </div>
    @else
        <small class="not-found-message">Nenhuma mensagem selecionada ainda 👀</small>
    @endif

</div>