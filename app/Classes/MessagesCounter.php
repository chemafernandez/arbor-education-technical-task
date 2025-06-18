<?php

namespace App\Classes;

use App\Interfaces\CountableInterface;
use App\Models\Message;
use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;

class MessagesCounter implements CountableInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Retrieve the number of SENT messages
     */
    public function countSentMessages(): int {
        $messageStatus = $_ENV['MESSAGE_TYPE_SENT'];
        $messagesList = $this->getMessagesByStatus($messageStatus);
        return $messagesList->count();
    }

    /**
     * Retrieve the number of DELIVERED messages
     */
    public function countDeliveredMessages(): int {
        $messageStatus = $_ENV['MESSAGE_TYPE_DELIVERED'];
        $messagesList = $this->getMessagesByStatus($messageStatus);
        return $messagesList->count();
    }

    /**
     * Retrieve the number of FAILED messages
     */
    public function countFailedMessages(): int {
        $messageStatus = $_ENV['MESSAGE_TYPE_FAILED'];
        $messagesList = $this->getMessagesByStatus($messageStatus);
        return $messagesList->count();
    }

    /**
     * Retrieve the number of REJECTED messages
     */
    public function countRejectedMessages(): int {
        $messageStatus = $_ENV['MESSAGE_TYPE_REJECTED'];
        $messagesList = $this->getMessagesByStatus($messageStatus);
        return $messagesList->count();
    }

    /**
     * Retrieve the list of messages by status type
     */
    private function getMessagesByStatus(string $statusType): Collection {
        $status = Status::where('name', $statusType)->get();
        $messagesList = Message::whereBelongsTo($status)->get();
        return $messagesList;
    }
}
