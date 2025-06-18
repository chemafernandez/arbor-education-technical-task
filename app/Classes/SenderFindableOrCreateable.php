<?php

namespace App\Classes;

use App\Interfaces\FindableOrCreateableInterface;
use App\Models\Sender;

class SenderFindableOrCreateable implements FindableOrCreateableInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Insert sender if it doesn't exist
     */
     public function findOrCreate(object $sms): int {
        $sender = Sender::where('snd_id', $sms->sender)->first();
        if (!$sender) {
            $sender = Sender::create([
                'snd_id' => $sms->sender,
            ]);
        }
        return $sender->id;
     }
}
