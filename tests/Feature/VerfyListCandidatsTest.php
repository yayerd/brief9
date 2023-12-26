<?php

namespace Tests\Feature;

use App\Http\Middleware\Candidat;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerfyListCandidatsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testListCandidats(): void
    {
        
       $admin = User::factory()->create([
            // 'nom' => 'fall',
            // 'prenom' => 'samba',
            // 'username' => 'sambaf',
            // 'email' => 'sambaf@example.com',
            // 'password' => bcrypt('secret'),
            // 'date_naissance' => '1990-01-01',
            'role_id' => 1
        ]);
    $response = $this->actingAs($admin, 'api');
        // $this->artisan('migrate');
        $this->withoutMiddleware();
        $response = $this->get('/api/candidats/list');

        $response->assertStatus(200);
    }
}
