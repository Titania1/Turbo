<?php

declare(strict_types=1);

namespace App\Observers;

use App\Order;

class OrderObserver
{
    /**
     * Handle the order "creating" event.
     *
     * @return void
     */
    public function creating(Order $order)
    {
        if (!$order->user_id) {
            $order->user_id = auth()->id();
        }
    }

    /**
     * Handle the order "created" event.
     *
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * Handle the order "updated" event.
     *
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the order "deleted" event.
     *
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
