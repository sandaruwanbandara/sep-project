<?php

namespace Tests\Feature\Menu;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\MenuType;
use App\Models\MenuItem;
use App\Models\Menu;

class MenusTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * Menu test
     *
     * @return void
     */
    public function test_menu_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/menu');
        $response->assertStatus(200);
    }
    /**
     * Menu test
     *
     * @return void
     */
    public function test_menu_can_be_created()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/menu',[
            'name' => 'Easy Test',
            'description' => $this->faker->text(),
            'available_from' => '09:00',
            'available_to' => '12:00',
            'availability' => 1,
            'display' => 1
        ]);
        $response->assertSessionHas("message", 'successfully created Easy Test menu');
    }
    /**
     * Menu test
     *
     * @return void
     */
    public function test_menu_can_be_updated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menu = Menu::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->put('/menu/update',[
            'id' => $menu->id,
            'name' => 'Easy Test Updated',
            'description' => $this->faker->text(),
            'available_from' => '09:00',
            'available_to' => '12:00',
            'availability' => 1,
            'display' => 1
        ]);
        $response->assertSessionHas("message", 'successfully update Easy Test Updated menu item');
    }
    /**
     * Menu test
     *
     * @return void
     */
    public function test_menu_can_be_deleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menu = Menu::factory()->create([
            'name' => 'Easy Menu',
            'user_id' => $user->id,
        ]);
        $response = $this->delete('/menu',[
            'id' => $menu->id
        ]);
        $response->assertSessionHas("message", 'successfully deleted Easy Menu menu item');
    }
    /**
     * Menu test
     *
     * @return void
     */
    public function test_menu_item_can_be_added()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menuType = MenuType::factory()->create([
            'user_id' => $user->id
        ]);
        $menuItem = MenuItem::factory()->create([
            'name' => 'Burger',
            'user_id' => $user->id,
            'type_id' => $menuType->id,
        ]);
        $menu = Menu::factory()->create([
            'name' => 'Dinner',
            'user_id' => $user->id,
        ]);
        $response = $this->post('/menu/add',[
            'menu_id' => $menu->id,
            'item_id' => $menuItem->id,
        ]);
        $response->assertSessionHas("message", 'successfully added '.$menuItem->name.' menu item to '.$menu->name);
    }
    /**
     * Menu test
     *
     * @return void
     */
    public function test_menu_item_can_be_removed()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menuType = MenuType::factory()->create([
            'user_id' => $user->id
        ]);
        $menuItem = MenuItem::factory()->create([
            'name' => 'Burger',
            'user_id' => $user->id,
            'type_id' => $menuType->id,
        ]);
        $menu = Menu::factory()->create([
            'name' => 'Dinner',
            'user_id' => $user->id,
        ]);
        $this->post('/menu/add',[
            'menu_id' => $menu->id,
            'item_id' => $menuItem->id,
        ]);
        $response = $this->delete('/menu/remove',[
            'menu_id' => $menu->id,
            'item_id' => $menuItem->id,
        ]);
        $response->assertSessionHas("message", 'successfully deleted menu item');
    }
    /**
     * Menu test
     *
     * @return void
     */
    public function test_menu_can_be_displayed()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menu = Menu::factory()->create([
            'name' => 'Easy Menu',
            'user_id' => $user->id,
        ]);
        $response = $this->get('/menu/'.$menu->id);
        $response->assertStatus(200);
    }
}
