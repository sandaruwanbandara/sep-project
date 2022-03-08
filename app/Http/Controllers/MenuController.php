<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;
use App\Models\Menu;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\MenuItem;

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
            'items' => Auth::user()->menu()->paginate(5)
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
            'items' => Auth::user()->menu_item()->with('type')->paginate(100)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
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
            'id' => 'required',
        ]);
        $item = Auth::user()->menu()->findOrFail($request->id);

        $item->delete();

        return redirect()->route('menu.index')->with(['message' => 'successfully deleted '.$item->name.' menu item']);
    }
}
