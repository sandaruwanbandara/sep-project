<?php

namespace Tests\Feature\MenuTypes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\MenuType;

class MenuTypesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * Menu types
     *
     * @return void
     */
    public function test_menu_types_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/menu-type');

        $response->assertStatus(200);
    }

    /**
     * Menu types
     *
     * @return void
     */
    public function test_menu_types_can_be_created()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->post('/menu-type',[
            'name' => 'Beverages',
            'display_name' => $this->faker->text()
        ]);

        $response->assertSessionHas("message", 'successfully created Beverages menu category');
    }

    /**
     * Menu types
     *
     * @return void
     */
    public function test_menu_types_can_be_updated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menuType = MenuType::factory()->create([
            'user_id' => $user->id
        ]);
        
        $response = $this->put('/menu-type/update',[
            'id' => $menuType->id,
            'name' => 'Updated Beverages',
            'display_name' => $this->faker->text()
        ]);
        $response->assertSessionHas("message", 'successfully update Updated Beverages menu category');
    }

    /**
     * Menu types
     *
     * @return void
     */
    public function test_menu_types_can_be_deleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menuType = MenuType::factory()->create([
            'user_id' => $user->id
        ]);
        
        $response = $this->delete('/menu-type',[
            'id' => $menuType->id
        ]);
        $response->assertSessionHas("message", 'successfully deleted Beverages menu category');
    }
}
