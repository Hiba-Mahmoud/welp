<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class FavoriteController extends Controller
{
    public function create()
    {
        try{

            User::find(request()->user_id)->Favorites()->firstOrCreate(['place_id'=>request()->place_id],['place_id'=>request()->place_id]);
            return response()->json(['data'=>User::find(request()->user_id)->Favorites,'status'=>200,'message'=>'successfully']);

        }catch(Throwable $e){
            return response()->json(['status'=>500,'message'=>'failed']);
        }
    }

    public function get($user_id)
    {
        return response()->json(['data'=>User::find($user_id)->Favorites,'status'=>200,'message'=>'successfully']);
    }

    public function delete()
    {
        try{
            Favorite::find(request()->favorite_id)->delete();
            return response()->json(['status'=>200,'message'=>'successfully']);
        }catch(Throwable $e){
            return response()->json(['status'=>500,'message'=>'failed']);
        }
    }
}
