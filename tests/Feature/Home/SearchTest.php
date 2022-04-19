<?php

namespace Tests\Feature\Home;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\MenuType;
use App\Models\MenuItem;
use App\Models\Menu;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_is_available()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_home_search_category_restaurants()
    {
        $response = $this->post('/',[
            'mainCategory' => 1
        ]);
        $response->assertStatus(200);
    }
    public function test_home_search_category_menus()
    {
        $response = $this->post('/',[
            'mainCategory' => 2,
            'slug' => 'test',
            'checkedFilters' => ['tf1']
        ]);
        $response->assertStatus(200);
    }
    public function test_home_search_category_dishes()
    {
        $response = $this->post('/',[
            'mainCategory' => 3,
            'slug' => 'test',
            'checkedFilters' => ['pf1']
        ]);
        $response->assertStatus(200);
    }

    public function test_home_show_restaurant()
    {
        $user = User::factory()->create();
        $response = $this->get('/show/restaurant/'.$user->id);
        $response->assertStatus(200);
    }

    public function test_home_show_menu()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menu = Menu::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->get('/show/menu/'.$menu->id);
        $response->assertStatus(200);
    }
    public function test_home_show_dish()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $menuType = MenuType::factory()->create([
            'name' => 'Noodles',
            'user_id' => $user->id
        ]);
        $menuItem = MenuItem::factory()->create([
            'name' => 'Submarine',
            'user_id' => $user->id,
            'type_id' => $menuType->id,
        ]);
        $this->app['auth']->logout();
        $response = $this->get('/show/dish/'.$menuItem->id);
        $response->assertStatus(200);
    }
}
