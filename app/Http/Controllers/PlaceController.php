<?php

namespace App\Http\Controllers;
use Throwable;
use Carbon\Carbon;
use App\Models\Place;
use App\Models\PlaceDetails;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\LazyCollection;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Pagination\LengthAwarePaginator;

class PlaceController extends Controller
{
    public function index()
    {
        return response()->json(['data'=>Place::all(),'status'=>200,'message'=>'successfully']);
    }

    public function withPagination()
    {
        return response()->json(['data'=>Place::paginate(7),'status'=>200,'message'=>'successfully']);
    }

    public function updateOrCreate()
    {
        try{

            Place::updateOrCreate(['id'=>request()->id],request()->only('title','image','available'));

            return response()->json(['status'=>200,'message'=>'successfully']);

        }catch(Throwable $e){

            return response()->json(['status'=>500,'message'=>'failed']);

        }
    }

    public function Scope(int $id)
    {
        if($id){
            return response()->json(['data'=>Place::find($id),'status'=>200,'message'=>'successfully']);
        }

        return response()->json(['status'=>404,'message'=>'id not found']);
    }



    public function places(){


        return response()->json(['data'=>Place::select(['id','category_id','image','name','full_address',])->with('category','ratingsCount','commentsCount',)->paginate(7),'status'=>200,'message'=>'successfully']);
        // $data = Place::select(['id','category_id','image','name','full_address',])->with('category','ratingsCount','commentsCount')->paginate(7);
        // $dataDate=  Carbon::parse('2023-01-12T17:46:01.000000Z')->subMinutes(2)->diffForHumans();
        // return response()->json(['data'=>[$data,$dataDate],'status'=>200,'message'=>'successfully']);

    }

    //api to get all places belongs to  a category
    public function placesBelongsToCategory(){
        $places = Place::where('category_id',request()->id)->paginate(7);
        return $places;
        // return response()->json(['data'=>Place::select(['id','category_id','image','name','full_address',])->with('category','ratingsCount','commentsCount',)->paginate(7),'status'=>200,'message'=>'successfully']);


    }

    // import data from csv file from public

    // old API return data from file to user

    public function import()
    {

        $data = SimpleExcelReader::create(public_path('database.csv'))->getRows();

        return response()->json(['data'=>collect($data)->paginate(7),'status'=>200,'message'=>'successfully']);

    }
    // ---------------------------



}
