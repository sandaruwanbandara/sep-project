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
        $this->menuType = $menuType;
    }

    public function index()
    {
        $user = Auth::user();
        return Inertia::render('MenuType', [
            'items' => MenuType::where('user_id',$user->id)->paginate(10)
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
        //dd($request->name);
        $request->validate([
            'name' => 'required',
        ]);
        
        $user = Auth::user();
       // dd($user->id);
        $this->menuType->create(['user_id' => $user->id, 'mt_name' => $request->name]);

        return redirect()->route('menu_type.index')->with(['message' => 'successfully created ' . $request->name . ' menu category']);
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
        $user = Auth::user();
        return Inertia::render('MenuTypeEdit', [
            'items' => MenuType::where('user_id',$user->id)->where('id',$id)->paginate(10)
        ]);
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

       $user = Auth::user();
       MenuType::where('user_id', $user->id)->where('id',$id)->update(['mt_name'=>$request->name]);

       return redirect()->route('menu_type.index')->with(['message' => 'successfully Updated' . $request->name . ' menu category']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       MenuType::destroy($id);

       return redirect()->route('menu_type.index')->with(['message' => 'Record successfully deleted']);
    }

    public function tblRender($item_count, $from_row, $to_row)
    {

        if ($item_count / 10 > 1) {
            $menuTypeResults = $this->menuType->select()->offset($from_row)->limit($to_row)->get();
        } else {
            $to_row = $item_count;
        }

        $page_info_arr = ['total_row_count' => $item_count, 'from_row' => $from_row, 'to_row' => $to_row];

        return [$page_info_arr];
    }
}