<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(['data'=>Category::all(),'status'=>200,'message'=>'successfully']);
    }

    public function withPagination()
    {
        return response()->json(['data'=>Category::paginate(7),'status'=>200,'message'=>'successfully']);
    }

    public function getPlacesFromCategory()
    {
        $validator = Validator::make(request()->all(),['category_id'=>'required']);


        if($validator->fails()){
            return response()->json(['status'=>500,'message'=>'failed','messageError'=>$validator->getMessageBag()]);

        }
        return response()->json(['data'=>Category::find(request()->category_id)->Places,'status'=>200,'message'=>'successfully']);
    }
// for admin
    public function updateOrCreate()
    {
        try{

            Category::updateOrCreate(['id'=>request()->id],request()->only('title','image'));

            return response()->json(['status'=>200,'message'=>'successfully']);

        }catch(Throwable $e){

            return response()->json(['status'=>500,'message'=>'failed']);

        }
    }


    public function Scope(int $id)
    {
        if($id){

            return response()->json(['data'=>Category::find($id),'status'=>200,'message'=>'successfully']);

        }

        return response()->json(['status'=>404,'message'=>'id not found']);
    }

}
