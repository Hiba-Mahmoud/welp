<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Netsells\GeoScope\Traits\GeoScopeTrait;
class Place extends Model
{
    use HasFactory,GeoScopeTrait;

    protected $fillable = [
        'name' , 'image', 'feature', 'Website','Municipality', 'phones', 'emails', 'street', 'full_address', 'google_map_url', 'latitude', 'longitude', 'PlaceFeatures', 'category_id'
    ];

    public function toArray()
    {
        return collect(parent::toArray())->merge([
            'Ratings' => $this->ratings,
            'RatingsAVG' => $this->ratings()->avg('rate'),
            'CategoryName' => $this->category->title,
            'Reviews' => $this->reviews()->exists()?$this->reviews:null,
            'PlaceFeatures' => json_decode($this->self->PlaceFeatures)
        ]);
    }


    public function self()
    {
        return $this->belongsTo(self::class,'id');
    }


    public function category()
    {
        return $this->belongsToMany(Category::class,'category_place');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }



    public function ratingsCount(): int
    {
        return count($this->ratings);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reviewCounts(): int
    {
        return count($this->reviews);
        // return $this->reviews()
        //     ->selectRaw('place_id, count(comment) as aggregate')
        //     ->groupBy('place_id');
    }

public function dateFormate(){

    return $this->selectRaw('created_at');
    // return Carbon::parse($date)->subMinutes(2)->diffForHumans();

}
// public function getHumanCreatedAtAttribute()
// {
//     return $this->dateFormate("created_at");

// }
}

