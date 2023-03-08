<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller
{
    public function Login()
    {

        if(Auth::attempt(request()->only('email','password'))){
            // if(!Auth::user()->email_verified_at){
            //     return response()->json(['status'=>500,'message'=>"this account has not verificated"]);
            // }
            return response()->json(['data'=>collect(Auth::user())->merge(['is_email_verificated'=>Auth::user()->email_verified_at ? true : false]),'status'=>200,'message'=>'successfully']);
        }
        return response()->json(['status'=>500,'message'=>"something wrong , i can't signin :) ,plz check email and password and try again"]);
    }

    public function Profile()
    {
        try{
            return response()->json(['data'=>collect(User::find(request()->user_id))->merge(['is_email_verificated'=>User::find(request()->user_id)->email_verified_at ? true : false]),'status'=>200,'message'=>'successfully']);
        }catch(Throwable $e){
            return $e;
            return response()->json(['status'=>500,'message'=>"can't find user"]);
        }
    }

    public function verifyEmail()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'user_id'=>'required',
            ],
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['data' => $errors, 'status' => 200, 'message' => 'error']);
        };

        try{
            event(new Registered(User::find(request()->user_id)));
            return response()->json(['status'=>200,'message'=>'successfully']);
        }catch(Throwable $e){
            return response()->json(['status' => 200, 'message' => 'error']);
        }
    }

    public function updateOrCreate()
    {
        $validation = validator::make(request()->all(),[
            'name'=>'required',
            'image'=>'mimes:png,jpg,jpeg',
            'city'=>'required',
            'age'=>'required',
            'gender'=>'required',
            'email'=>'required|email',
            'password'=>'required',

        ]);
        if($validation->fails()){
            return response()->json(['status'=>500,'message'=>$validation->getMessageBag()]);
        }
        try{
            $imagePath = '';
            if(request()->hasFile('image')){
                $imagePath = upload(request()->file('image'),'profile_image');
            }

            $user = User::updateOrCreate(['id'=>request()->id],
            [
                'name'=>request()->name,
                'image'=>$imagePath,
                'age'=>request()->age,
                'city'=>request()->city,
                'gender'=>request()->gender,
                'email'=>request()->email,
                'password'=>request()->password,
            ]);

            $user->password = Hash::make(request()->password);
            $user->save();

            if(request()->id){
                return response()->json(['status'=>200,'message'=>'account has been updated']);
            }

            return response()->json(['data'=>User::find($user->id),'status'=>200,'message'=>'account has been created']);
        }catch(Throwable $e){
            $validation = validator()->make(request()->only('email'),[
                'email'=>'unique:users,email'
            ]);

            if($validation->fails()){
                return response()->json(['status'=>500,'message'=>$validation->getMessageBag()->get('email')[0]]);
            }

            return response()->json(['status'=>500,'message'=>'failed to create account','errorMessage'=>$e]);
        }
    }
}
