<?php

namespace App\Livewire\Chat;

use Livewire\Component;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class Application extends Component
{

    public ?User $user = null;

    public function mount()
    {

        $this->user = Auth::user();

    }

    public function render()
    {
        return view('livewire.chat.application');
    }
}
