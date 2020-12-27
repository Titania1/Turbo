<?php

declare(strict_types=1);

namespace Tests\Feature\Catalog;

use App\Brand;
use App\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Storage::disk('public')->deleteDirectory('brands');
        Storage::disk('public')->makeDirectory('brands');
    }

    /**
     * Test brand models collection.
     *
     * Assert that a brand can have many models.
     *
     * Create a fake brand.
     * Attach two instances of fake models to that brand.
     * Assert that brand models is an instance of eloquent collection
     * Hit the brand route
     * Assert that we can see the brand name
     * Assert a successful HTTP status code
     */
    public function test_brand_models_collection(): void
    {
        $brand = create(Brand::class);
        $brand->models()->createMany(
            // 'make' => temporary non persisted instances
            create(Model::class, [], 'make', 2)->toArray()
        );
        $this->assertInstanceOf(Collection::class, $brand->models);
        $response = $this->get(route('brand', $brand));
        $response->assertSee($brand->name);
        $response->assertOk();
    }
}
