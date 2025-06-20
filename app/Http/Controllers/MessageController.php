<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $conversations = $user->conversations()
            ->with(['participants', 'lastMessage'])
            ->latest()
            ->get();

        return Inertia::render('Messages/Index', [
            'conversations' => $conversations,
        ]);
    }

    public function show(Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        $messages = $conversation->messages()
            ->with('sender')
            ->latest()
            ->paginate(20);

        return Inertia::render('Messages/Show', [
            'conversation' => $conversation,
            'messages' => $messages,
        ]);
    }

    public function store(Request $request, Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = $conversation->messages()->create([
            'sender_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return response()->json($message->load('sender'));
    }

    public function markAsRead(Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        $conversation->messages()
            ->where('sender_id', '!=', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    public function quickMessage(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        $conversation = Conversation::firstOrCreate([
            'type' => 'direct',
        ]);

        $conversation->participants()->syncWithoutDetaching([
            auth()->id(),
            $validated['recipient_id'],
        ]);

        $message = $conversation->messages()->create([
            'sender_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return response()->json($message->load('sender'));
    }
} 