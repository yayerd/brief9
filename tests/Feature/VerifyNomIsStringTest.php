<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerifyNomIsStringTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testPrenomIsString()
    {
        $user = User::factory()->create(['prenom' => 65757, 'role_id' => 2]);
        
        // $data = [
        //     'prenom' =>     'hello', 
        // ];

        // $candidat = User::factory()->make($data);

        // $this->assertFalse($candidat->save()); 
        // $this->assertNotNull($candidat->getError('prenom')); 

        
        $this->withoutMiddleware();
        $this->assertIsString($user->prenom);
    }
}
