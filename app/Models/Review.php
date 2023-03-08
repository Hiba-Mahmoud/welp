<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['comment','place_id','user_id'];


    public function toArray()
    {
        return collect(parent::toArray())->merge([
            'user' => $this->user->only('name','image','country'),
            'Rating' => $this->Rate
        ]);
    }

    protected $hidden = ['user_id','place_id'];

    public function Rate()
    {
        return $this->hasOne(Rating::class  );

    }
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
