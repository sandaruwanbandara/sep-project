<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;
use App\Models\Menu;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\MenuItem;
use App\Models\ItemsInMenu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Menu',[
            'user' => Auth::user(),
            'items' => Auth::user()->menu()->with('items')->paginate(5)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'available_from' => 'required',
            'available_to' => 'required',
            'availability' => 'required',
            'display' => 'required',
        ]);

        $user = Auth::user();

        $user->menu()->create([
            'name' => $request->name,
            'description' => $request->description,
            'available_from' => $request->available_from,
            'available_to' => $request->available_to,
            'availability' => (bool)$request->availability ? 1 : 0,
            'display' => (bool)$request->display ? 1 : 0,
        ]);

        return redirect()->route('menu.index')->with(['message' => 'successfully created '.$request->name.' menu']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Auth::user()->menu()->findOrFail($id);

        return Inertia::render('MenuShow',[
            'user' => Auth::user(),
            'menu' => $menu,
            'items' => Auth::user()->menu_item()->with('type')->paginate(100),
            'menu_items' => $menu->items()->with('menu_item','menu_item.type')->paginate(100)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:menus,id',
            'name' => 'required',
            'available_from' => 'required',
            'available_to' => 'required',
            'availability' => 'required',
            'display' => 'required',
        ]);
        $user = Auth::user();
        $item = Auth::user()->menu()->findOrFail($request->id);
        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'available_from' => $request->available_from,
            'available_to' => $request->available_to,
            'availability' => (bool)$request->availability ? 1 : 0,
            'display' => (bool)$request->display ? 1 : 0,
        ]);

        return redirect()->route('menu.index')->with(['message' => 'successfully update '.$request->name.' menu item']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:menus,id',
        ]);
        $menu = Auth::user()->menu()->findOrFail($request->id);
        $items = $menu->items;
        //validate existing items and cancel deletion
        if($items->isNotEmpty()){
            return redirect()->back()->withErrors(['message' => 'You cannot delete a Menu with items. This menu has '.$items->count(). ' items. Please clean the items first and retry']);
        }

        $menu->delete();

        return redirect()->route('menu.index')->with(['message' => 'successfully deleted '.$menu->name.' menu item']);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addItem(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'item_id' => 'required|exists:menu_items,id',
        ]);
        $user = Auth::user();
        $menu = Auth::user()->menu()->findOrFail($request->menu_id);
        $item = Auth::user()->menu_item()->findOrFail($request->item_id);
        $itemExists = $menu->items->where('menu_item_id',$request->item_id);
        
        if($itemExists->isNotEmpty()){
            return redirect()->back()->withErrors(['message' => 'This item is already added to '.$menu->name]);
        }

        $user->items_in_menu()->create([
            'menu_id' => $request->menu_id,
            'menu_item_id' => $request->item_id,
        ]);

        return redirect()->back()->with(['message' => 'successfully added '.$item->name.' menu item to '.$menu->name]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteItem(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'item_id' => 'required|exists:items_in_menu,id',
        ]);
        $user = Auth::user();
        $item = Auth::user()->items_in_menu()->findOrFail($request->item_id);

        $item->delete();

        return redirect()->back()->with(['message' => 'successfully deleted menu item']);
    }
}
