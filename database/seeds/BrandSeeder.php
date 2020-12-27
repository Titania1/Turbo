<?php

declare(strict_types=1);

use App\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        factory(Brand::class, 2);
    }
}
