<?php

declare(strict_types=1);

namespace App\Observers;

use App\Client;

class ClientObserver
{
    /**
     * Handle the client "creating" event.
     *
     * @return void
     */
    public function creating(Client $client)
    {
        if (auth()->check()) {
            $client->user_id = auth()->id();
        }
    }
}
