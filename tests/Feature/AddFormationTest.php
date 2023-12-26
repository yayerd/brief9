<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddFormationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testAddNewFormation(): void
    {
        $user = User::factory()->create(['role_id' => 1]);
        
        // Informations de la candidature
        $formationData = [
            'titre' => fake()->name(),
            'criteres' => fake()->name(),
            'duree' => fake()->randomNumber(),
            // 'etat' => fake()->string(),
            // 'archive' => fake()->name(),
            'created_at'=>now(),
            'updated_at'=>now()
        ];
        
        // $this->withoutMiddleware();
        $response = $this->actingAs($user)->post('/api/formation/store', $formationData);

        // $response->assertStatus(200); 
        $response->assertSuccessful();
        $this->assertDatabaseHas('formations', $formationData + ['user_id' => $user->id]);
    }
}
