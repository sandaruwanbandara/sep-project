<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        return Inertia::render('MenuType',[
            'user' => Auth::user(),
            'items' => [
                ['id' => 1, 'name' => 'Rice', 'display_name' => 'Rice', 'created_at' => '2022-02-18 18:53:34', 'updated_at' => '2022-02-18 18:53:34'],
                ['id' => 2, 'name' => 'Soup', 'display_name' => 'Soup', 'created_at' => '2022-02-18 18:53:34', 'updated_at' => '2022-02-18 18:53:34'],
                ['id' => 3, 'name' => 'Noodles', 'display_name' => 'Noodles', 'created_at' => '2022-02-18 18:53:34', 'updated_at' => '2022-02-18 18:53:34'],
                ['id' => 1, 'name' => 'Koththu', 'display_name' => 'Koththu', 'created_at' => '2022-02-18 18:53:34', 'updated_at' => '2022-02-18 18:53:34'],
                ['id' => 1, 'name' => 'Pasta', 'display_name' => 'Pasta', 'created_at' => '2022-02-18 18:53:34', 'updated_at' => '2022-02-18 18:53:34'],
            ]
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

        return redirect()->route('menu_type.index')->with(['message' => 'successfully created '.$request->name.' menu category']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
