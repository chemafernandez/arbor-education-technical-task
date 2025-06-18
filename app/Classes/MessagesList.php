<?php

namespace App\Classes;

use App\Interfaces\ListableInterface;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class MessagesList implements ListableInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Retrieve ALL messages
     */
    public function getAllMessages(): Collection {
        $messagesList = Message::all();
        return $messagesList;
    }

    /**
     * Retrieve messages grouped by recipient
     */
    public function getMessagesGroupedByRecipient(): Collection {
        $messagesList = $this->getAllMessages();
        $messagesListGrouped = $messagesList->groupBy('recipient_id');
        return $messagesListGrouped;
    }
}
