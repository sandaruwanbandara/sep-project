<?php

namespace Tests\Feature\MenuItems;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\MenuType;
use App\Models\MenuItem;

class MenuItemsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * Menu items
     *
     * @return void
     */
    public function test_menu_items_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/menu-item');
        $response->assertStatus(200);
    }
    /**
     * Menu items
     *
     * @return void
     */
    public function test_menu_items_can_be_created()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menuType = MenuType::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->post('/menu-item',[
            'user_id' => $user->id,
            'type' => $menuType->id,
            'name' => 'Dinner',
            'description' => $this->faker->text(),
            'price' => 1000,
            'availability' => 1,
            'display' => 1
        ]);
        $response->assertSessionHas("message", 'successfully created Dinner menu item');
    }
    /**
     * Menu items
     *
     * @return void
     */
    public function test_menu_items_can_be_updated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menuType = MenuType::factory()->create([
            'user_id' => $user->id
        ]);
        $menuItem = MenuItem::factory()->create([
            'user_id' => $user->id,
            'type_id' => $menuType->id,
        ]);
        $response = $this->put('/menu-item/update',[
            'id' => $menuItem->id,
            'type' => $menuType->id,
            'name' => 'Dinner updated',
            'description' => $this->faker->text(),
            'price' => 1000,
            'availability' => 1,
            'display' => 1
        ]);
        $response->assertSessionHas("message", 'successfully update Dinner updated menu item');
    }
    /**
     * Menu items
     *
     * @return void
     */
    public function test_menu_items_can_be_deleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menuType = MenuType::factory()->create([
            'user_id' => $user->id
        ]);
        $menuItem = MenuItem::factory()->create([
            'name' => 'Dinner',
            'user_id' => $user->id,
            'type_id' => $menuType->id,
        ]);
        $response = $this->delete('/menu-item',[
            'id' => $menuItem->id
        ]);
        $response->assertSessionHas("message", 'successfully deleted Dinner menu item');
    }
}
