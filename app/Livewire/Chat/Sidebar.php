<?php

namespace App\Livewire\Chat;

use Livewire\Attributes\Computed;
use Livewire\Component;

use App\Models\Message;
use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

#[On('sidebar::refresh')]
class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.chat.sidebar');
    }

    #[Computed]
    public function loadMessages()
    {

        $authUserId = auth()->id();

        $senders = DB::table('messages')
            ->where('receiver_id', $authUserId)
            ->pluck('sender_id');

        $following = DB::table('subscribers')
            ->where('user_channel_id', $authUserId)
            ->pluck('user_subscriber_id');

        $userIds = $senders->merge($following)->unique()->values();

        $users = User::whereIn('id', $userIds)->get();

        $messages = $users->map(function ($user) use ($authUserId) {
      
            $pendingCount = DB::table('messages')
                ->where('sender_id', $user->id)
                ->where('receiver_id', $authUserId)
                ->whereNull('viewed_at')
            ->count();

            $lastMessage = DB::table('messages')
                ->where(function ($query) use ($authUserId, $user) {
                    $query->where('sender_id', $authUserId)->where('receiver_id', $user->id);
                })
                ->orWhere(function ($query) use ($authUserId, $user) {
                    $query->where('sender_id', $user->id)->where('receiver_id', $authUserId);
                })
                ->orderByDesc('created_at')
            ->first();

            $user->pending_count = $pendingCount;
            $user->last_message = $lastMessage?->message;
            $user->last_sender_id = $lastMessage?->sender_id;
            $user->last_message_at = $lastMessage?->created_at;

            return $user;
        });

        return $messages;

    }

    #[On('chat::enterMessage')]
    public function enterMessage($selectedUser)
    {
        $user = User::where('username', $selectedUser)->first();

        $this->dispatch('chat::setContextUser', $user);
    }
}
