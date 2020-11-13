<?php

declare(strict_types=1);

namespace App\Observers;

use App\Car;

class CarObserver
{
    /**
     * Handle the car "creating" event.
     */
    public function creating(Car $car): void
    {
        $car->slug = sluggify($car->type);
    }

    /**
     * Handle the car "updating" event.
     */
    public function updating(Car $car): void
    {
        if ($car->isDirty('type')) {
            $car->slug = sluggify($car->type);
        }
    }
}
