<?php

declare(strict_types=1);

namespace App\Observers;

use App\Type;

class TypeObserver
{
    /**
     * Handle the type "creating" event.
     *
     * @return void
     */
    public function creating(Type $type)
    {
        $type->slug = sluggify($type->name);
    }

    /**
     * Handle the type "created" event.
     *
     * @return void
     */
    public function created(Type $type)
    {
        // Just app/public because the image attribute already includes 'types' folder name
        if ($type->image) {
            $type->addMedia(storage_path('app/public/'.$type->image))
                ->preservingOriginal()
                ->toMediaCollection();
        }
    }

    /**
     * Handle the type "updating" event.
     *
     * @return void
     */
    public function updating(Type $type)
    {
        if ($type->isDirty('name')) {
            $type->slug = sluggify($type->name);
        }
    }

    /**
     * Handle the type "updated" event.
     *
     * @return void
     */
    public function updated(Type $type)
    {
        // Just app/public because the image attribute already includes 'types' folder name
        if ($type->isDirty('image')) {
            $type->addMedia(storage_path('app/public/'.$type->image))
                ->preservingOriginal()
                ->toMediaCollection();
        }
    }

    /**
     * Handle the type "deleted" event.
     *
     * @return void
     */
    public function deleted(Type $type)
    {
        //
    }

    /**
     * Handle the type "restored" event.
     *
     * @return void
     */
    public function restored(Type $type)
    {
        //
    }

    /**
     * Handle the type "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Type $type)
    {
        //
    }
}
