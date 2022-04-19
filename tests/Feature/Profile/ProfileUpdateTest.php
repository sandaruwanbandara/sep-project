<?php

namespace Tests\Feature\Profile;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    /**
     * User profile page test
     *
     * @return void
     */
    public function test_profile_can_be_rendered()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
    }

    /**
     * User profile page test
     *
     * @return void
     */
    public function test_profile_can_be_updated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/profile',[
            'name' => $this->faker->name(),
            'about' => $this->faker->text(),
            'contact' => $this->faker->numerify('#########')
        ]);
        $response->assertSessionHas("message", "successfully updated the profile");
    }
}
