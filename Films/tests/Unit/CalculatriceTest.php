<?php
namespace Tests\Unit;
use Tests\TestCase;
use App\Services\CalculatriceService;

class CalculatriceTest extends TestCase{
    /**
    * @test
    */
    public function it_can_calculate_sum_of_two_numbers(){
        $calculatrice = new CalculatriceService();
        $resultat = $calculatrice->somme(5, 3);
        $this->assertEquals(8, $resultat);
    }

}