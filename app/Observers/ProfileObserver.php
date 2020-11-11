<?php

declare(strict_types=1);

namespace App\Observers;

use App\Profile;

class ProfileObserver
{
    /**
     * Handle the profile "created" event.
     */
    public function created(Profile $profile): void
    {
        if (!$profile->user->provider) { // if user isn't logged in via a 3rd party provider (google or facebook)
            // Just app/public because the image attribute already includes 'avatars' folder name
            $profile->addMedia(storage_path('app/public/'.$profile->avatar))
                ->preservingOriginal()
                ->toMediaCollection();
        }
    }
}
