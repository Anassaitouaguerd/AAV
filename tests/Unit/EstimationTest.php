<?php

namespace Tests\Unit;

use Tests\TestCase;

class EstimationTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_price_can_be_calculated()
    {
        $response = $this->postJson('/api/Estimation-Voitures',  [
            'marque' => 'bmw',
            'modele' => 'x1'
        ]);
        $response->assertStatus(202);
        // $this->assertTrue(true);
    }
}