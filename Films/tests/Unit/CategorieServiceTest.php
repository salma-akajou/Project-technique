<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Categorie;
use App\Services\CategorieService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategorieServiceTest extends TestCase
{
    use RefreshDatabase;

    protected CategorieService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CategorieService(new Categorie());
    }

    public function test_it_can_get_all_categories()
    {
        Categorie::factory()->count(3)->create();

        $categories = $this->service->getAll();

        $this->assertEquals(3, $categories->count());
    }
}
