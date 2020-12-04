<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function home_route_should_return_the_homepage()
    {
        $response = $this->call('GET', '/');
        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }
    
}
