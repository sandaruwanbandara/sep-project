<?php

namespace App\Http\Controllers;

use App\Models\MenuType;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class MenuTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(MenuType $menuType)
    {
        $this->menuType = $menuType ;
    }

    public function index(Request $request)
    {
        return Inertia::render('MenuType',[
            'user' => Auth::user(),
            'items' => Auth::user()->menu_type()->paginate()
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
            'display_name' => 'required'
        ]);

        $user = Auth::user();

        $user->menu_type()->create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        return redirect()->route('menu_type.index')->with(['message' => 'successfully created '.$request->name.' menu category']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required',
            'id' => 'required|exists:menu_types',
        ]);
        $item = Auth::user()->menu_type()->find($request->id);

        $item->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        return redirect()->route('menu_type.index')->with(['message' => 'successfully update '.$request->name.' menu category']);
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
        $item = Auth::user()->menu_type()->find($request->id);

        $item->delete();

        return redirect()->route('menu_type.index')->with(['message' => 'successfully deleted '.$item->name.' menu category']);
    }
}
