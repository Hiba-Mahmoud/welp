<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function QueryGet($Query = null)
    {
        if($Query){
            return response()->json(['data'=>Place::where('name','LIKE','%'.$Query.'%')->get(),'status'=>200,'message'=>'Query has been founded']);
        }
        return response()->json(['status'=>500,'message'=>'Query has not founded']);
    }

    public function QueryPost()
    {

        if(Request()->Query){
            return response()->json(['data'=>Place::where('name','LIKE','%'.Request()->Query.'%')->get() ?? null,'status'=>200,'message'=>'Query has been founded']);
        }
        return response()->json(['status'=>500,'message'=>'Query has not founded']);
    }

    public function getPlacesByNearMe()
    {
        if(!request()->Query){
            $data = collect(Place::withinDistanceOf(request()->lat, request()->lon, request()->distance)->get()->toArray())->map(function($map){
                return collect($map)->merge(['Distance'=>getDistance(
                    $map['longitude'],
                    $map['latitude'],
                    request()->lon,
                    request()->lat
                )]);
            });
        }else{
            $data = collect(Place::where('name','LIKE','%'.request()->Query.'%')->withinDistanceOf(request()->lat, request()->lon, request()->distance)->get()->toArray())->map(function($map){
                return collect($map)->merge(['Distance'=>getDistance(
                    $map['longitude'],
                    $map['latitude'],
                    request()->lon,
                    request()->lat
                )]);
            });
        }

        return response()->json(['data'=>$data,'status'=>200,'message'=>'successfully'],200);
    }
}
