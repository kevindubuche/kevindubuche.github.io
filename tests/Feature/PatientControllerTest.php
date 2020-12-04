<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Models\Patient;

class PatientControllerTest extends TestCase
{
    use DatabaseTransactions; 
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
   /** @test */
   public function route_index_patients_displays_the_index()
   {
    $name = $this->faker->name;
    $email = $this->faker->safeEmail;
    $password = $this->faker->password(8);
     $user = factory(User::class)->create();

      // $response = $this->actingAs($user)->get('patients');
       $response = $this->actingAs($user)->get(route('patients.index'));
  

        $response->assertStatus(200);
    //    $response->assertViewIs('patients.index');
    $response->assertViewHas('patients');
   }

     /** @test */
     public function patient_peut_prendre_rendez_vous()
     {
    
         $user = factory(User::class)->create();
         
         $patient = factory(Patient::class)->create();
    
         $response = $this->actingAs($user)->post('hospital', [
             'submit' => 'patient_demande_une_autre_date',
        
         ]);

         $response->assertStatus(302);
    
         
     }
 
 
}
