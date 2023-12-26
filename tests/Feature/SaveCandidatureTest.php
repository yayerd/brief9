<?php

namespace Tests\Feature;

use App\Models\Candidature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SaveCandidatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testAjouterCandidature()
    {
      
        $user = User::factory()->create();
        $this->actingAs($user);
        $candidature = Candidature::factory()->create();
        $response = $this->post("/api/candidature/store/3");

        $response->assertStatus(200);
        // $this->assertDatabaseHas('candidatures', $candidatureData + ['user_id' => $user->id]);
    }
}
