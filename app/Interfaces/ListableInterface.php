<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ListableInterface
{
    public function getAllMessages(): Collection;
    public function getMessagesGroupedByRecipient(): Collection;
}
