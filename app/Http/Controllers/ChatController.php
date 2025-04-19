<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;


class ChatController extends Controller
{
    public function index(Request $request)
{
    $userId = Auth::id();

    // Get all users except the current user
    $users = User::where('id', '!=', $userId)
        ->orderBy('name')
        ->get();

    // Get receiver ID from request
    $receiver_id = $request->query('receiver_id');

    // Fetch chats between current user and the selected receiver
    $chats = collect();
    if ($receiver_id) {
        // Mark unread messages as read
        Chat::where('sender_id', $receiver_id)
            ->where('receiver_id', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $chats = Chat::where(function ($query) use ($userId, $receiver_id) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', $receiver_id);
            })
            ->orWhere(function ($query) use ($userId, $receiver_id) {
                $query->where('sender_id', $receiver_id)
                      ->where('receiver_id', $userId);
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    // Fetch unread message counts for each user
    $unreadCounts = $users->mapWithKeys(function ($user) use ($userId) {
        // Count unread messages for each user (sent to current user)
        $unreadCount = Chat::where('sender_id', $user->id)
            ->where('receiver_id', $userId)
            ->whereNull('read_at')
            ->count();
        
        return [$user->id => $unreadCount];
    });

    return view('chats.index', compact('chats', 'users', 'receiver_id', 'unreadCounts'));
}

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $chat = Chat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        broadcast(new ChatMessageSent($chat))->toOthers();

        return response()->json(['success' => true, 'chat' => $chat]);
    }
}
