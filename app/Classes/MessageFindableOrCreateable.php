<?php

namespace App\Classes;

use App\Interfaces\FindableOrCreateableInterface;
use App\Models\Message;

class MessageFindableOrCreateable implements FindableOrCreateableInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Insert message if it doesn't exist
     */
     public function findOrCreate(object $sms): int {
        $message = Message::where('msg_id', $sms->id)->first();
        if (!$message) {
            $date = date_create($sms->timestamp);
            $dateFormatted = date_format($date, "Y-m-d H:i:s");
               
            $message = Message::create([
                'msg_id'        => $sms->id,
                'webhook'       => $sms->webhook,
                'subject'       => $sms->subject,
                'body'          => $sms->message,
                'timestamp'     => $dateFormatted,
                'recipient_id'  => $sms->recipient_id,
                'sender_id'     => $sms->sender_id,
                'student_id'    => $sms->student_id,
                'provider_id'   => $sms->provider_id,
                'status_id'     => $sms->status_id,
            ]);
        }
        return $message->id;
     }
}
