<?php

namespace App\Livewire\Chat;

use Livewire\Component;

use App\Models\User;
use App\Models\Subscriber;
use App\Models\Message;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class Application extends Component
{
    public ?User $user = null;

    public function mount()
    {
        $this->user = Auth::user();
    }

    #[Computed]
    public function verifyMessages()
    {
        $senders = count( Message::where('receiver_id', $this->user->id)->get() );

        $followings = count( Subscriber::where('user_subscriber_id', $this->user->id)->get() );

        return $senders || $followings;
    }

    #[On('chat::refresh')]
    public function refresh()
    {
        $this->dispatch('sidebar::refresh');

        $this->dispatch('message::refresh');
    }

    public function render()
    {
        return view('livewire.chat.application');
    }
}
