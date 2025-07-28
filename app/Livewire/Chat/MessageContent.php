<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class MessageContent extends Component
{
    public ?User $contextUser = null;

    public ?Collection $contextMessages = null;

    public ?User $authUser = null;

    public ?string $message = null;

    public function mount()
    {
        $this->authUser = Auth::user();
    }

    public function render()
    {
        return view('livewire.chat.message-content');
    }

    #[On('message::refresh')]
    public function refresh(bool $saveContext = false)
    {
        if ( ! $saveContext ) {
            $this->reset('contextUser');
        }

        $this->setContextMessages( $this->getContextMessages() );

        $this->reset('message');

        $this->dispatch('sidebar::refresh');
    }

    public function sendMessage()
    {
        Message::create([
            'sender_id' => $this->authUser->id,
            'receiver_id' => $this->contextUser->id,
            'message' => $this->message
        ])->save();

        $this->dispatch('message::refresh', true);
    }

    public function setContextMessages($contextMessages)
    {

        $this->contextMessages = $contextMessages;

        $this->dispatch('updated-messages');

    }

    public function getContextMessages()
    {
        if ( ! $this->contextUser ) {
            return null;
        }

        return Message::where(function ($query) {
            $query->where('sender_id', $this->contextUser->id)
                ->where('receiver_id', $this->authUser->id);
        })
        ->orWhere(function ($query) {
            $query->where('sender_id', $this->authUser->id)
                ->where('receiver_id', $this->contextUser->id);
        })
        ->with('sender')
        ->selectRaw('messages.*, sender_id = ? as is_author', [$this->authUser->id])
        ->orderBy('created_at', 'asc')
        ->get();
    }

    #[On('chat::setContextUser')]
    public function setContextUser(User $user)
    {
        $this->contextUser = $user;

        $this->setContextMessages( $this->getContextMessages() );
    }

    public function getContextUser()
    {
        return $this->contextUser;
    }
}
