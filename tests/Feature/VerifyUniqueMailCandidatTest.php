<?php

namespace Tests\Feature;

use App\Http\Middleware\Candidat;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory; 
use Tests\TestCase;

class VerifyUniqueMailCandidatTest extends TestCase
{
    // use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    // public function testMailUnique(): void
    // {
    //     Candidat::factory()->create(['email' => 'test@example.com']); 
    //     $response = $this->get('/');


    //     $response->assertStatus(200);
    // }

    // public function testUniqueEmail()
    // {
    //     // Créer un utilisateur avec une adresse e-mail existante
    //     $existingUser = User::factory()->create(['email' => 'test@example.com']);

    //     // Tenter de créer un nouvel utilisateur avec la même adresse e-mail
    //     $response = $this->post('/register', [
    //         'prenom' => 'Testons',
    //         'nom' => 'Test',
    //         'username' => 'testonsici',
    //         'email' => 'test@example.com',
    //         'password' => 'password',
    //         'password_confirmation' => 'password',
    //         'role_id' => 2
    //     ]);

    //     // Assurez-vous que la validation échoue en raison de l'adresse e-mail existante
    //     $response->assertSessionHasErrors('email');

    //     // Vérifiez que la base de données n'a pas été modifiée (pas d'utilisateur supplémentaire)
    //     $this->assertDatabaseCount('users', 1);
    // }

    public function testEmailUnique()
    {
        
        User::factory()->create(['email' => 'fallll@example.com',
        'role_id' => 2  ]);
        //  'role_id' => 2 
        $data = [
            'email' => 'fallll@example.com', 
        ];
        
        $this->withoutMiddleware();
        $this->artisan('migrate');
        $candidat = User::factory()->make($data);
        $this->assertFalse($candidat->save()); 
        $this->assertNotNull($candidat->getError('email')); 

    }

}
