<?php

namespace App\Interfaces;

interface RateableInterface
{
    public function calculateRate(int $rateableMessages, int $totalMessages): float;
}
