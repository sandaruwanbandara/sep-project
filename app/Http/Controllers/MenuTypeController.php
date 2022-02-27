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
        $this->menuType =$menuType ;

    }

    public function index(Request $request)
    {

        $request->validate([
            'from' => 'integer',
            'to' => 'integer'
        ]);

        $user =  Auth::user();
        $menuTypeResults = $this->menuType->select()->where('user_id',$user->id)->get();
        $item_count = $menuTypeResults->count();

        $from_row =1;
        $to_row  = 1;

        if($item_count/10 > 1){
           // dd($request->content);
            if(empty($request->content)){
                $menuTypeResults = $menuTypeResults->slice(0,10);
                $to_row  = 10;
            }else{

            }
        }else{
            $to_row = $item_count;
        }

        $item_arr = $menuTypeResults->toArray();

        $page_info_arr = ['total_row_count'=>$item_count,'from_row' => $from_row,'to_row'=>$to_row];

        return Inertia::render('MenuType',[
            'user' => Auth::user(),
            'items' => $item_arr,
            'page_info' => $page_info_arr
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
        ]);

        $this->menuType->create(['user_id'=>Auth::user()->id,'mt_name'=>$request->name]);

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

    public function tblRender($item_count,$from_row,$to_row){

        if($item_count/10 > 1){
            $menuTypeResults = $this->menuType->select()->offset($from_row)->limit($to_row)->get();
        }else{
            $to_row = $item_count;
        }

        $page_info_arr = ['total_row_count'=>$item_count,'from_row' => $from_row,'to_row'=>$to_row];

        return [$page_info_arr];
    }
}
