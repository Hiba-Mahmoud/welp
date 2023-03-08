<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Place;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Services\UploaderService;
use App\Http\Services\UploaderServices;
use Illuminate\Support\Facades\Validator;
use Spatie\SimpleExcel\SimpleExcelReader;

class PlaceDetailsController extends Controller
{
    // csv file input from admin to database


    public function importCsv(Request $request){
        // validation starts
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required|mimes:csv,xlsx',
                'category_id' => 'required',
            ],

        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['data'=>$errors,'status'=>200,'message'=>'error']);
            // return $this->apiResponse(0, 'error', $errors);
            // return $errors;
        };

        // validation ends


        $filePath = upload($request->file,'csvFiles');
        $data = json_decode(SimpleExcelReader::create(public_path($filePath))->getRows());

        for($i = 0 ; $i < count($data) ; $i++){
            Place::firstOrCreate([
                'name' => $data[$i]->Name,
                'feature' => $data[$i]->Feature,
                'image' => $data[$i]->{'Featured Image'},
                'Website' => $data[$i]->Website,
                'Municipality' => $data[$i]->Municipality,
                'phones' => $data[$i]->Phones,
                'emails' => $data[$i]->Emails,
                'street' => $data[$i]->Street,
                'full_address' => $data[$i]->{'Full Address'},
                // this forien shoud e deleted
                'category_id'=>$request->category_id,
                // google map is writen wrong in csv file
                'google_map_url' => $data[$i]->{'Google Maps URL'},
                'latitude' =>$data[$i]->Latitude,
                'longitude'=>$data[$i]->Longitude,
            ]);
        }

        return response()->json(['data'=>Place::paginate(7),'status'=>200,'message'=>'successfully']);

    }

    public function createOrupdate(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'name'=> 'required',
                'feature'=> 'required',
                'image'=> 'required',
                'Website'=> 'required',
                'Municipality'=> 'required',
                'phones'=> 'required',
                'emails'=> 'required',
                'street'=> 'required',
                'full_address'=> 'required',
                'category_id'=> 'required',
                'google_map_url'=> 'required',
                'latitude'=> 'required',
                'longitude'=> 'required',
            ],

        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['data'=>$errors,'status'=>200,'message'=>'error']);
        };
        // validation ends
        Place::Create([
                'name' => $request->name,
                'feature' => $request->feature,
                'image' => upload($request->image,'places_images') ,
                'Website' => $request->Website,
                'Municipality' => $request->Municipality,
                'phones' => $request->phones,
                'emails' => $request->emails,
                'street' => $request->street,
                'full_address' => $request->full_address,
                // this forien shoud e deleted
                'category_id'=>$request->category_id,
                // google map is writen wrong in csv file
                'google_map_url' => $request->google_map_url,
                'latitude' =>$request->latitude,
                'longitude'=>$request->longitude,
            ]);
            dd($request);


        return response()->json(['data'=>Place::paginate(7),'status'=>200,'message'=>'successfully']);


    }


    public function scope(){

    }
}
// Category::find(request()->category_id)->
