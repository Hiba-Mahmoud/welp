<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class RatingController extends Controller
{
    public function index()
    {
        return response()->json(['data'=>Rating::all(),'status'=>200,'message'=>'successfully']);
    }

    public function create()
    {

        $validation = Validator::make(request()->all(),[
            'rate'=>'required',
            'place_id'=>'required',
            // 'review_id'=>'required'
        ]);

        if($validation->fails()){
            return response()->json(['status'=>500,'message'=>$validation->getMessageBag()]);
        }

        try{
            Rating::create(request()->all());
            return response()->json(['status'=>200,'message'=>'successfully']);
        }catch(Throwable $e){
            return response()->json(['status'=>500,'message'=>'failed to create new rate','errorMessage'=>$e]);
        }

    }
}
