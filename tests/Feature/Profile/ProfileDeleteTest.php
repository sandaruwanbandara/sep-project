<?php

namespace Tests\Feature\Profile;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ProfileDeleteTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * Profile delete
     *
     * @return void
     */
    public function test_profile_can_be_deleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/delete',[
            'password' => 'password',
            'email' => $user->email
        ]);
        $response->assertRedirect('/');
    }

    public function test_profile_can_be_deleted_with_invalid_password()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/delete',[
            'password' => 'invalid_password',
            'email' => $user->email
        ]);
        $response->assertSessionHasErrors(['password']);
    }

    public function test_profile_can_be_deleted_with_invalid_email()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/delete',[
            'password' => 'password',
            'email' => 'invalid_email@gmail.com'
        ]);
        $response->assertSessionHasErrors(['email']);
    }
}
