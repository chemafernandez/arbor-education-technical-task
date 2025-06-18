<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sender extends Model
{
    protected $guarded = [];

    /**
     * Retrieve the list of messages by sender id
     */
    public function messages(): HasMany {
        return $this->hasMany(Message::class);
    } 
}
