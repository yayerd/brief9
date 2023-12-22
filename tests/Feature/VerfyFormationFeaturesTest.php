<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerfyFormationFeaturesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * A test for add formation feature test example.
     */
    public function testListeFormations(): void
    {
        $this->artisan('migrate');
        $response = $this->get('/api/formations/list');

        $response->assertStatus(200);
    }
}
