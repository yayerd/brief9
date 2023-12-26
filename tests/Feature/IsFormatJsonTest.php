<?php

namespace Tests\Feature;

use App\Models\Candidature;
use App\Models\Formation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IsFormatJsonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testFormatJson()
    {

        $user = User::factory()->create();
        // $candidatures = Candidature::factory()->count(2);  ->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get('/api/candidatures/list');
        // dump($response->json());
        $response->assertStatus(200);
        
        $response->assertJsonStructure([
                // "status_message",
                "status_code",
                "candidatures" => [
                    '*' => [
                        // 'id', 'titre', 'criteres',
                        // 'duree', 'etat', 'archive',
                        // 'created_at', 'updated_at',
                    ]
                ]
            ]);
    }
}
