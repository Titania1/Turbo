<?php

declare(strict_types=1);

use App\Supplier;
use App\User;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids = User::select('id')->pluck('id')->toArray();
        foreach ($ids as $id) {
            // Create the user associated supplier (treated as a profile)
            factory(Supplier::class)->create(['user_id' => $id, 'owner_id' => $id]);
            // Create suppliers owner by the user
            factory(Supplier::class, 5)->create(['owner_id' => $id]);
        }
    }
}
