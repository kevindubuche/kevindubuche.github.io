<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Models\Hospital;
class HospitalControllerTest extends TestCase
{
    use DatabaseTransactions; 
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
      /** @test */
      public function route_index_hospital_displays_the_index()
      {
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $password = $this->faker->password(8);
        $user = factory(User::class)->create();

          $response = $this->actingAs($user)->get('hospital');
  
          $response->assertStatus(200);
          $response->assertViewIs('hospital.index');
      }

         /** @test */
         public function route_show_hospital_displays_the_show()
         {
           $user = factory(User::class)->create();

            
        $hospital = factory(Hospital::class)->create();
        $liste_de_villes_associees_a_hospital = ["Carrefour","Petit-Goave","Delmas"];

        $response = $this->actingAs($user)->post('hospital', [
            'nom' => $hospital->nom ,
            'adresse' => $hospital->adresse ,
            'code_hospital' =>  $hospital->code_hospital ,
            'maximum_visites_par_jour' =>  $hospital->maximum_visites_par_jour ,
            'commune' => $hospital->commune ,
            'departement' =>  $hospital->departement ,
            'multiclass' => $liste_de_villes_associees_a_hospital,
       
        ]);

        $check_hospital = Hospital::where('id', $hospital->id)->first();
        $this->assertNotNull($check_hospital);
   
            //  $response = $this->actingAs($user)->get('hospital');
             $response = $this->actingAs($user)->get(route('hospital.show', $hospital->id));
     
             $response->assertStatus(200);
             $response->assertViewIs('hospital.show');
         }
      /** @test */
      public function route_edit_hospital_displays_the_edit_form()
      {
        $user = factory(User::class)->create();

         
     $hospital = factory(Hospital::class)->create();
     $liste_de_villes_associees_a_hospital = ["Carrefour","Petit-Goave","Delmas"];

     $response = $this->actingAs($user)->post('hospital', [
         'nom' => $hospital->nom ,
         'adresse' => $hospital->adresse ,
         'code_hospital' =>  $hospital->code_hospital ,
         'maximum_visites_par_jour' =>  $hospital->maximum_visites_par_jour ,
         'commune' => $hospital->commune ,
         'departement' =>  $hospital->departement ,
         'multiclass' => $liste_de_villes_associees_a_hospital,
    
     ]);

     $check_hospital = Hospital::where('id', $hospital->id)->first();
     $this->assertNotNull($check_hospital);

          $response = $this->actingAs($user)->get(route('hospital.edit', $hospital->id));
  
          $response->assertStatus(200);
          $response->assertViewIs('hospital.edit');
          $response->assertViewHas('hospital');
          $response->assertViewHas('anciennesAssignations');
      }


        /** @test */
    public function create_and_hospital()
    {
   
        $user = factory(User::class)->create();
        
        $hospital = factory(Hospital::class)->create();
        $liste_de_villes_associees_a_hospital = ["Carrefour","Petit-Goave","Delmas"];

        $response = $this->actingAs($user)->post('hospital', [
            'nom' => $hospital->nom ,
            'adresse' => $hospital->adresse ,
            'code_hospital' =>  $hospital->code_hospital ,
            'maximum_visites_par_jour' =>  $hospital->maximum_visites_par_jour ,
            'commune' => $hospital->commune ,
            'departement' =>  $hospital->departement ,
            'multiclass' => $liste_de_villes_associees_a_hospital,
       
        ]);

        $check_hospital = Hospital::where('nom', $hospital->nom)->where('code_hospital', $hospital->code_hospital)->first();
        $this->assertNotNull($check_hospital);

        $response->assertStatus(302);
        $response->assertRedirect('hospital');
        $this->assertDatabaseHas('hospitals', [
            'id' => $check_hospital->id ,
           
        ]);
        
    }



    /** @test */
    public function update_and_hospital()
    {
   
        $user = factory(User::class)->create();
        
        $hospital = factory(Hospital::class)->create();
        $liste_de_villes_associees_a_hospital = ["Carrefour","Petit-Goave","Delmas"];

        $response = $this->actingAs($user)->post('hospital', [
            'nom' => $hospital->nom ,
            'adresse' => $hospital->adresse ,
            'code_hospital' =>  $hospital->code_hospital ,
            'maximum_visites_par_jour' =>  $hospital->maximum_visites_par_jour ,
            'commune' => $hospital->commune ,
            'departement' =>  $hospital->departement ,
            'multiclass' => $liste_de_villes_associees_a_hospital,
       
        ]);

        $check_hospital = Hospital::where('id', $hospital->id)->first();
        $this->assertNotNull($check_hospital);

        $response->assertStatus(302);
        $response->assertRedirect('hospital');
        $this->assertDatabaseHas('hospitals', [
            'id' => $check_hospital->id ,
           
        ]);



        ///update part
        $hospital_modified = factory(Hospital::class)->create();
        $liste_de_villes_associees_a_hospital_modified = ["Carrefour2","Petit-Goave2","Delmas2"];
       
        // $this->put(route('posts.update', $post->id), $data)
        $response = $this->actingAs($user)->put(route('hospital.update', $hospital->id), [
            'nom' => $hospital_modified->nom ,
            'adresse' => $hospital_modified->adresse ,
            'code_hospital' =>  $hospital_modified->code_hospital ,
            'maximum_visites_par_jour' =>  $hospital_modified->maximum_visites_par_jour ,
            'commune' => $hospital_modified->commune ,
            'departement' =>  $hospital_modified->departement ,
            'multiclass' => $liste_de_villes_associees_a_hospital_modified,
       
        ]); 
        $response->assertStatus(302);
        $response->assertRedirect('hospital');
        $this->assertDatabaseHas('hospitals', [
            'id' => $hospital_modified->id ,
            'adresse' => $hospital_modified->adresse ,
            'code_hospital' =>  $hospital_modified->code_hospital ,
            'maximum_visites_par_jour' =>  $hospital_modified->maximum_visites_par_jour ,
            'commune' => $hospital_modified->commune ,
            'departement' =>  $hospital_modified->departement ,
           
        ]);
        
    }

     /** @test */
     public function can_delete_a_hostiptal() 
     {
        $user = factory(User::class)->create();
        
        $hospital = factory(Hospital::class)->create();
        $liste_de_villes_associees_a_hospital = ["Carrefour","Petit-Goave","Delmas"];

        $response = $this->actingAs($user)->post('hospital', [
            'nom' => $hospital->nom ,
            'adresse' => $hospital->adresse ,
            'code_hospital' =>  $hospital->code_hospital ,
            'maximum_visites_par_jour' =>  $hospital->maximum_visites_par_jour ,
            'commune' => $hospital->commune ,
            'departement' =>  $hospital->departement ,
            'multiclass' => $liste_de_villes_associees_a_hospital,
       
        ]);

        $check_hospital = Hospital::where('id', $hospital->id)->first();
        $this->assertNotNull($check_hospital);

        $response->assertStatus(302);
        $response->assertRedirect('hospital');
        $this->assertDatabaseHas('hospitals', [
            'id' => $check_hospital->id ,
           
        ]);

         //delete part
         
         $response = $this->call('DELETE', '/hospital/'.$hospital->id);
         $this->assertEquals(302, $response->getStatusCode());
         $this->assertDatabaseMissing('hospitals', ['id' => $hospital->id]);
 }
    
}
