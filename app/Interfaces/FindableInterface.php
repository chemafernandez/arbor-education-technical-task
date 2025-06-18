<?php

namespace App\Interfaces;

interface FindableInterface
{
    public function find(object $sms): int;
}
