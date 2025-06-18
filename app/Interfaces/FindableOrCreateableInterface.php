<?php

namespace App\Interfaces;

interface FindableOrCreateableInterface
{
    public function findOrCreate(object $sms): int;
}
