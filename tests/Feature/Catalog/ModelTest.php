<?php

declare(strict_types=1);

namespace Tests\Feature\Catalog;

use App\Brand;
use App\Model;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ModelTest extends TestCase
{
    /**
     * Test that we can create a catalog model
     * And we can navigate to it.
     */
    public function test_catalog_model_route(): void
    {
        $this->withoutExceptionHandling();
        Storage::disk('public')->deleteDirectory('brands');
        Storage::disk('public')->makeDirectory('brands');
        $brand = create(Brand::class);
        $this->assertInstanceOf(Brand::class, $brand);
        $model = create(Model::class, [], 'make')->toArray();
        $this->assertIsArray($model);
        $model = $brand->models()->create($model);
        $this->assertInstanceOf(Model::class, $model);
    }
}
