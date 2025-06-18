<?php

namespace App\Classes;

use App\Interfaces\FindableOrCreateableInterface;
use App\Models\Provider;

class ProviderFindableOrCreateable implements FindableOrCreateableInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Insert provider if it doesn't exist
     */
     public function findOrCreate(object $sms): int {
        $provider = Provider::where('name', $sms->extra->provider)->first();
        if (!$provider) {
            $provider = Provider::create([
                'name' => $sms->extra->provider,
            ]);
        }
        return $provider->id;
     }
}
