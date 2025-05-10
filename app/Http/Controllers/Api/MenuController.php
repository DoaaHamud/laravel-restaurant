<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\menu;
use Exception;

class MenuController extends Controller
{
    public function ContentMenu(Request $request){
        try{
        $validatedata=$request->validate([
            "name"=>"required|string",
            "price"=>"required|numeric",
            "description"=>"required"

        ]);
        $menu=menu::create($validatedata);
        if($menu){
           return response()->json(['status'=>'تم','message'=>'success insert dat','data'=>$menu],200) ;
        }
        }catch (Exception $e){
            return response()->json(['status'=>'error','message'=>$e->getMessage()],500);
        }
    }
    public function GetContentMenu() {
        $menu=menu::all();
        return response()->json(['status'=>'success','message'=>'successfully get data','data'=>$menu],200);
    } 

     public function GetContentMenu_id($id) {
        $menu=menu::findOrFail($id);
        return response()->json(['status'=>'success','message'=>'successfully get data','data'=>$menu],200);
    } 
    
    public function UpdateContentMenu(Request $request, $id){
        $menu=menu::findOrFail($id);
        $validatedata= $request->validate([
            "name"=>"sometimes|string",
            "price"=>"sometimes|numeric",
            "description"=>"sometimes"

        ]);
        $menu->update($validatedata);
        return response()->json(['status'=>'success','message'=>'successfully update data','data'=>$menu],200);
    }
    public function DeleteContentMenu($id){
        $menu=menu::findOrFail($id);
        $menu->delete();
        return response()->json(null,204);
    }
}
