<?php

namespace App\Http\Controllers;

use App\Models\Demo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
   
    public function getAllData()
    {
        $data = Demo::get();
       
        return response()->json($data);
    }
    public function form_submit(Request $request)
    {
        
       $demo = new Demo();
       $demo->name = $request->name;
       $demo->save();

        return response()->json($demo);
    }

    public function getData($id)
    {
        $data = Demo::find($id);
        return response()->json($data);
    }

    public function updateForm(Request $request)
    {
        $demo = Demo::find($request->id);
        $demo->name = $request->name;
        $demo->save();

        return response()->json($demo);
    }

    public function deleteForm($id)
    {
        $demo = Demo::find($id);
        $demo->delete();

        return response()->json(['success'=>'deleted']);
        
    }
}
