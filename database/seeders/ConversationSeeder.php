<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    public function run()
    {
        $conversations = [
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'title' => 'Translation Project Discussion',
                'sender_viewed' => true,
                'receiver_viewed' => false
            ]
        ];

        foreach ($conversations as $conversation) {
            Conversation::create($conversation);
        }
    }
}
