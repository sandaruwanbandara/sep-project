<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Models\MenuItem;
use App\Models\ItemsInMenu;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class SearchController extends Controller
{
     /**
     * Display home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = $this->searchRestaurants("",[]);
        
        return Inertia::render('Welcome', [
            'canLogin' =>  $this->setAuthRoutes(),
            'canRegister' =>  $this->setAuthRoutes(),
            'products' => $restaurants
        ]);
    }
    /**
     * Search with Filters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function homeSearch(Request $request)
    {
        // $contains = in_array('pf1',$request->checkedFilters);
        // return $contains;
        $type = $request->mainCategory;
        $items = [];
        if($type == 1){
            $items = $this->searchRestaurants($request->slug,[]);    
        }else if($type ==2){
            $items = $this->searchMenus($request->slug,$request->checkedFilters);    
        }else if($type ==3){
            $items = $this->searchDishes($request->slug,$request->checkedFilters);    
        }
        return Inertia::render('Welcome', [
            'canLogin' => $this->setAuthRoutes(),
            'canRegister' =>  $this->setAuthRoutes(),
            'products' => $items
        ]);
    }

    /**
     * Search restaurats and return results
     */
    private function searchRestaurants($slug, $filters){

        $users = User::get(['id','name','about','contact']);
        if(!empty($slug)){
            $users = User::where('name', 'LIKE', "%$slug%")->get(['id','name','about','contact']);
        }
        $list = [];
        foreach ($users as $user) {
           $item = [];
           $item['id'] = $user->id;
           $item['name'] = $user->name;
           $item['desc'] = $user->about;
           $item['href'] = route("show.restaurant",['id' => $user->id]);
           $item['img'] = "/images/cafe.png";
           $item['fld_one'] = sprintf("%u menus",$user->menu()->count());
           $item['fld_two'] = sprintf("Call for more info %s",$user->contact);
           $list[] = $item;
        }
        return $list;
    }

    /**
     * Search restaurats and return results
     */
    private function searchMenus($slug, $filters){

        $menus = Menu::display()->get();
        if(!empty($slug)){
            $menus = Menu::display()->where('name', 'LIKE', "%$slug%")->get();
        }
        if(in_array('tf1',$filters)){
            $menus = $menus->where('available_from', '>=', "06:00:00")->where('available_to', '<=', "10:00:00");
        }
        if(in_array('tf2',$filters)){
            $menus = $menus->where('available_from', '>=', "10:00:00")->where('available_to', '<=', "16:00:00");
        }
        if(in_array('tf3',$filters)){
            $menus = $menus->where('available_from', '>=', "18:00:00")->where('available_to', '<=', "24:00:00");
        }
        if(in_array('tf4',$filters)){
            $menus = $menus->where('available_from', '>=', "15:00:00")->where('available_to', '<=', "21:00:00");
        }
        if(in_array('af1',$filters)){
            $menus = $menus->where('availability',"Yes");
        }else if(in_array('af2',$filters)){
            $menus = $menus->where('availability',"No");
        }
        $list = [];
        foreach ($menus as $menu) {
           $item = [];
           $item['id'] = $menu->id;
           $item['name'] = $menu->name;
           $item['desc'] = $menu->description;
           $item['href'] = route("show.menu",['id' => $menu->id]);
           $item['img'] = "/images/menucard.png";
           $item['fld_one'] = sprintf("%u items",$menu->items()->count());
           $item['fld_two'] = sprintf("By %s. Available from %s hrs to %s hrs. (Availability : %s)", $menu->user->name, $menu->available_from, $menu->available_to,$menu->availability);
           $list[] = $item;
        }
        return $list;
    }

    /**
     * Search restaurats and return results
     */
    private function searchDishes($slug, $filters){
        
        $menuItems = MenuItem::display()->with('type')->get();
        if(!empty($slug)){
            $menuItems = MenuItem::display()->where('name', 'LIKE', "%$slug%")->with('type')->get();
        }
        if(in_array('pf1',$filters)){
            $menuItems = $menuItems->where('price', '<=', 100);
        }
        if(in_array('pf2',$filters)){
            $menuItems = $menuItems->whereBetween('price', [100,200]);
        }
        if(in_array('pf3',$filters)){
            $menuItems = $menuItems->whereBetween('price', [200,300]);
        }
        if(in_array('pf4',$filters)){
            $menuItems = $menuItems->whereBetween('price', [500,1000]);
        }
        if(in_array('pf5',$filters)){
            $menuItems = $menuItems->whereBetween('price', [1000,5000]);
        }
        if(in_array('pf6',$filters)){
            $menuItems = $menuItems->where('price', '>=', 5000);
        }
        if(in_array('af1',$filters)){
            $menuItems = $menuItems->where('availability',"Yes");
        }else if(in_array('af2',$filters)){
            $menuItems = $menuItems->where('availability',"No");
        }
        $list = [];
        foreach ($menuItems as $menu) {
           $item = [];
           $item['id'] = $menu->id;
           $item['name'] = $menu->name;
           $item['desc'] = $menu->description;
           $item['href'] = route("show.dish",['id' => $menu->id]);
           $item['img'] = "/images/dish.png";
           $item['fld_one'] = sprintf("%s LKR",$menu->price);
           $item['fld_two'] = sprintf("By %s. In %s.  (Availability : %s)",$menu->user->name, $menu->type->name, $menu->availability);
           $list[] = $item;
        }
        return $list;
    }

    /**
     * Check user is authenticated
     */
    private function setAuthRoutes(){
        $user =  Auth::user();
        if($user){
            return false;
        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRestaurant($id)
    {
        $user = User::findOrFail($id);
        $menus = $user->menu()->display()->get();
        $list = [];
        foreach ($menus as $menu) {
           $item = [];
           $item['id'] = $menu->id;
           $item['name'] = $menu->name;
           $item['desc'] = $menu->description;
           $item['href'] = route("show.menu",['id' => $menu->id]);
           $item['img'] = "/images/menucard.png";
           $item['fld_one'] = sprintf("%u items",$menu->items()->count());
           $item['fld_two'] = sprintf("available from %s hrs to %s hrs. (Availability : %s)" ,$menu->available_from, $menu->available_to, $menu->availability);
           $list[] = $item;
        }
        return Inertia::render('ShowRestaurant',[
            'canLogin' =>  $this->setAuthRoutes(),
            'canRegister' =>  $this->setAuthRoutes(),
            'name' => $user->name,
            'desc' => sprintf("%s. For more call %s",$user->about, $user->contact),
            'products' => $list
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDish($id)
    {
        $item = MenuItem::display()->find($id);
        return Inertia::render('ShowDish',[
            'canLogin' =>  $this->setAuthRoutes(),
            'canRegister' =>  $this->setAuthRoutes(),
            'name' => sprintf("%s by %s",$item->name, $item->user->name),
            'desc' => $item->description,
            'price' => sprintf("%s LKR",$item->price),
            'availability' => sprintf("Available: %s",$item->availability),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMenu($id)
    {
        $menucard = Menu::display()->findOrFail($id);
        $menus = $menucard->items;
        $list = [];
        foreach ($menus as $menu) {
           if($menu->menu_item->display == "Yes"){
            $item = [];
            $item['id'] = $menu->id;
            $item['name'] = $menu->menu_item->name;
            $item['desc'] = $menu->menu_item->description;
            $item['href'] = route("show.dish",['id' => $menu->menu_item->id]);
            $item['img'] = "/images/dish.png";
            $item['fld_one'] = sprintf("%s LKR",$menu->menu_item->price);
            $item['fld_two'] = sprintf("In %s. (Availability : %s)",$menu->menu_item->type->name, $menu->menu_item->availability);
            $list[] = $item;
           }
        }
        return Inertia::render('ShowRestaurant',[
            'canLogin' =>  $this->setAuthRoutes(),
            'canRegister' =>  $this->setAuthRoutes(),
            'name' => sprintf("%s. By %s",$menucard->name, $menucard->user->name),
            'desc' => sprintf("%s. Available from %s hrs to %s hrs",$menucard->description,$menucard->available_from, $menucard->available_to),
            'products' => $list
        ]);
    }
}
