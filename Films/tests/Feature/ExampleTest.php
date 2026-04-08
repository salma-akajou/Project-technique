<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\FilmService;
use Mockery;
use Illuminate\Pagination\LengthAwarePaginator;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $mockService = Mockery::mock(FilmService::class);
        $paginator = new LengthAwarePaginator([], 0, 10);
        $mockService->shouldReceive('getAll')->once()->andReturn($paginator);

        $this->instance(FilmService::class, $mockService);

        $response = $this->get('/accueil');

        $response->assertStatus(200);
    }
}
