<?php

namespace App\Classes;

use App\Interfaces\FindableInterface;
use App\Models\Status;

class StatusFindable implements FindableInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Retrieve status
     */
     public function find(object $sms): int {
        $status = Status::where('name', $sms->status)->first();
        return $status->id;
     }
}
