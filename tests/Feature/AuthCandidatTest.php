<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthCandidatTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testAuthCandidat(): void
    {
        $admin = User::factory()->create(['role_id' => 1]); 
        $this->withoutMiddleware();
        $this->actingAs($admin);
        $response = $this->post('/api/auth/login');
        $response->assertStatus(200);
    }
}
