<?php

declare(strict_types=1);

namespace App\Observers;

use App\Vehicle;

class VehicleObserver
{
    /**
     * Handle the vehicle model "creating" event.
     *
     * Sluggify the vehicle name before DB insertion.
     */
    public function creating(Vehicle $vehicle): void
    {
        $vehicle->slug = sluggify($vehicle->name);
    }

    /**
     * Handle the vehicle model "updating" event.
     *
     * Sluggify the new name if changed.
     */
    public function updating(Vehicle $vehicle): void
    {
        if ($vehicle->isDirty('name')) {
            $vehicle->slug = sluggify($vehicle->name);
        }
    }
}
