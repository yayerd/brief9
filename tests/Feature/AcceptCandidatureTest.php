<?php

namespace Tests\Feature;

use App\Models\Candidature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AcceptCandidatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testAcceptCandidature(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $candidature = Candidature::factory()->create(
            ["statut"=>"acceptee"]
        );
        $response = $this->post("/api/candidature/store/3");

        $response->assertStatus(200);
    }
}

