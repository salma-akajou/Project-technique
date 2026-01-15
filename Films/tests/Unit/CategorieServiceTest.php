<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Models\Categorie;
use App\Services\CategorieService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategorieServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_all_categories()
    {
        Categorie::create(['nom' => 'Histoire']);
        Categorie::create(['nom' => 'Drama']);
        Categorie::create(['nom' => 'Comedy']);

        $service = new CategorieService();
        $categories = $service->getAll();

        $this->assertCount(3, $categories);
    }
}
