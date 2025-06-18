<?php

namespace App\Classes;

use App\Interfaces\RateableInterface;

class MessagesRater implements RateableInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Retrieve messages rate
     */
    public function calculateRate(int $rateableMessages, int $totalMessages): float {
        $rate = ($rateableMessages * 100) / $totalMessages;
        return number_format($rate, 2, '.', '');
    }
}
