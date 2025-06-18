<?php

namespace App\Classes;

use App\Interfaces\FindableOrCreateableInterface;
use App\Models\Recipient;

class RecipientFindableOrCreateable implements FindableOrCreateableInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Insert recipient if it doesn't exist
     */
     public function findOrCreate(object $sms): int {
        $recipient = Recipient::where('phone_number', $sms->recipient)->first();
        if (!$recipient) {
            $recipient = Recipient::create([
                'phone_number' => $sms->recipient,
            ]);
        }
        return $recipient->id;
     }
}
