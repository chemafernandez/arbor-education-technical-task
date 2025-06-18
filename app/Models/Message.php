<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $guarded = [];

    /**
     * Retrieve recipient details of a messages
     */
    public function recipient(): BelongsTo {
        return $this->belongsTo(Recipient::class);
    }

    /**
     * Retrieve sender details of a messages
     */
    public function sender(): BelongsTo {
        return $this->belongsTo(Sender::class);
    }
    
    /**
     * Retrieve student details of a messages
     */
    public function Student(): BelongsTo {
        return $this->belongsTo(Student::class);
    }
    
    /**
     * Retrieve provider details of a messages
     */
    public function provider(): BelongsTo {
        return $this->belongsTo(provider::class);
    }
    
    /**
     * Retrieve status details of a messages
     */
    public function status(): BelongsTo {
        return $this->belongsTo(Status::class);
    }
}
