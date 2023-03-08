<?php

namespace App\Http\Controllers\ClientSide;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    // create Comment
    public function createComment(Request $request)
    {
        // validation starts
        $validator = Validator::make(
            $request->all(),
            [
                'comment' => 'required|string',
                'place_id'=>'required|integer',
                'user_id'=>'required|integer',
            ],
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['data' => $errors, 'status' => 200, 'message' => 'error']);
        };

        // validation ends
        // $comment = Review::create($request->all());
        $comment = Place::find($request->place_id)->reviews()->create($request->only('comment','user_id'));
        return response()->json(['data' => $comment, 'status' => 200, 'message' => 'success']);

    }
}
