<?php

declare(strict_types=1);

namespace App\Observers;

use App\Garage;

class GarageObserver
{
    /**
     * Handle the garage "creating" event.
     */
    public function creating(Garage $garage): void
    {
        // This check is only useful when seeding
        if (auth()->check()) {
            $garage->user_id = auth()->id();
        }
    }

    /**
     * Handle the garage "created" event.
     *
     * @return void
     */
    public function created(Garage $garage)
    {
        //
    }

    /**
     * Handle the garage "updated" event.
     *
     * @return void
     */
    public function updated(Garage $garage)
    {
        //
    }

    /**
     * Handle the garage "deleted" event.
     *
     * @return void
     */
    public function deleted(Garage $garage)
    {
        //
    }

    /**
     * Handle the garage "restored" event.
     *
     * @return void
     */
    public function restored(Garage $garage)
    {
        //
    }

    /**
     * Handle the garage "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Garage $garage)
    {
        //
    }
}
