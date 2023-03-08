<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // reviews
    // public function index()
    // {

    //     return response()->json(['data'=>Review::all(),'status'=>200,'message'=>'successfully']);
    // }

    public function withPagination()
    {
        return response()->json(['data'=>Review::paginate(7),'status'=>200,'message'=>'successfully']);
    }

    // this is instead of index and editfunctions

    public function Review(Request $request){

        $reviews = Review::where(function($query)use($request){
            if($request->has('place_id')){
                $query->where('place_id',$request->place_id);
            }
        })->get();

        return response()->json(['data'=>$reviews,'status'=>200,'message'=>'successfully']);
    }


    //dashboard
    // users
    //list users
    public function listUsers()
    {
        return response()->json(['data'=>User::paginate(7),'status'=>200,'message'=>'successfully']);

    }
    //list banned users
    public function listBannedUsers()
    {
        return response()->json(['data'=>User::onlyTrashed()->paginate(7),'status'=>200,'message'=>'successfully']);

    }
    //banned users
    public function bannedUser()
    {
        $user = User::findOrFail(request()->id)->delete();
        return response()->json(['data'=>$user,'status'=>200,'message'=>'user has been banned successfully']);
    }

    //restore user from trash
    public function restoreUser()
    {
        $user = User::withTrashed()->find(request()->id)->restore();
        return response()->json(['data'=>$user,'status'=>200,'message'=>'user has been restored successfully']);

    }

    //list comments
    public function listComments()
    {
        # code...
    }
}
