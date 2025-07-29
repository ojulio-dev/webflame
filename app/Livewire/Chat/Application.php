<?php

namespace App\Livewire\Chat;

use App\Models\Subscriber;
use Livewire\Component;

use App\Models\User;
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
    public function followings()
    {
        return count(Subscriber::where('user_subscriber_id', $this->user->id)->get());
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
