<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('MenuItem',[
            'user' => Auth::user(),
            'types' => Auth::user()->menu_type,
            'items' => Auth::user()->menu_item()->with('type')->paginate(5)
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
            'type' => 'required|exists:menu_types,id',
            'name' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'availability' => 'required',
            'display' => 'required',
        ]);

        $user = Auth::user();

        $type = Auth::user()->menu_type()->findOrFail($request->type);

        $user->menu_item()->create([
            'type_id' => $request->type,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'availability' => (bool)$request->availability ? 1 : 0,
            'display' => (bool)$request->display ? 1 : 0,
        ]);

        return redirect()->route('menu_item.index')->with(['message' => 'successfully created '.$request->name.' menu item']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuItemRequest  $request
     * @param  \App\Models\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:menu_items,id',
            'type' => 'required|exists:menu_types,id',
            'name' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'availability' => 'required',
            'display' => 'required',
        ]);
        $user = Auth::user();
        $type = Auth::user()->menu_type()->findOrFail($request->type);
        $item = Auth::user()->menu_item()->find($request->id);

        $item->update([
            'type_id' => $request->type,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'availability' => (bool)$request->availability ? 1 : 0,
            'display' => (bool)$request->display ? 1 : 0,
        ]);

        return redirect()->route('menu_item.index')->with(['message' => 'successfully update '.$request->name.' menu item']);
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
        $item = Auth::user()->menu_item()->find($request->id);

        $item->delete();

        return redirect()->route('menu_item.index')->with(['message' => 'successfully deleted '.$item->name.' menu item']);
    }
}
