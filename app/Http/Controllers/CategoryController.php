<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show()
    {
        $category = DB::select('select * from categories order by name asc');
        return response()->json(['categories'=>$category],200);
    }

    public function add(Request $request)
    {
            $data = $request->all();

            $rules = [

                'id'=>'required|unique:users',
                'name'=>'required|unique:users'
            ];

            $customMessage = [

                'id.required'=>'id is not auto generated',
                'name.required'=>'must use unique name'
            ];

            $validator = validator::make($data , $rules , $customMessage);

            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }

            $category = new Category();

            $category->id = $data['id'];
            $category->name = $data['name'];
            $category->description = $data['description'];
          
            try {
                // $category->save();
                $k = 100/0;
                return response()->json(['data'=>'success'],201);
              }
              catch(Exception $e) {
                return response()->json(['data'=>$e],400);
              }

            
        
    }
}
