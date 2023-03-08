<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = ['review_id','place_id','rate'];

    public function places(){
        return $this->belongsTo(Place::class);
    }


    protected $hidden = ['place_id','review_id'];


}
