<?php

namespace App\Interfaces;

interface CountableInterface
{
    public function countSentMessages(): int;
    public function countDeliveredMessages(): int;
    public function countFailedMessages(): int;
    public function countRejectedMessages(): int;
}
