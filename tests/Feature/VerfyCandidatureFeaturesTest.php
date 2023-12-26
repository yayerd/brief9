<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerfyCandidatureFeaturesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testListeCanditatures(): void
    {
        $this->artisan('migrate');
        $this->withoutMiddleware();
        $response = $this->get('/api/candidatures/list');

        $response->assertStatus(200);
    }
}
