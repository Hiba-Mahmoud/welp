<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Faker\Factory;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;




// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Place;
use App\Models\Rating;
use App\Models\Review;
use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'client','guard_name'=>'api']);
        Role::create(['name' => 'writer','guard_name'=>'api']);
        Role::create(['name' => 'admin','guard_name'=>'api']);
        Role::create(['name' => 'super_admin','guard_name'=>'api']);

        User::create([
            'name'=>'Admin',
            'city' => 'egypt',
            'age' => '20',
            'gender' => 'male',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('admin@admin.com')
        ])->assignRole(['super_admin','client','admin','writer']);

        $faker = Factory::create();
        //add more users
        for($i = 0; $i < 20; $i++){
            User::create([
                'name'=>$faker->name,
                'country' => 'egypt',
                'age' => '80',
                'gender'=>$faker->randomElement(['male','female']),
                'email'=> $faker->email,
                'password'=>bcrypt('123456789'),
            ]);
        };


        Category::create(['title'=>'Restaurants','image'=>asset('assets/images/Categories/svgexport-7 (3).png')]);
        Category::create(['title'=>'Coffee','image'=>asset('assets/images/Categories/svgexport-7 (5).png')]);
        Category::create(['title'=>'Hotels','image'=>asset('assets/images/Categories/svgexport-7 (6).png')]);
        Category::create(['title'=>'Markets','image'=>asset('assets/images/Categories/svgexport-7 (7).png')]);
        Category::create(['title'=>'Hospitals','image'=>asset('assets/images/Categories/svgexport-7 (4).png')]);
        Category::create(['title'=>'Companys','image'=>asset('assets/images/Categories/svgexport-7 (8).png')]);
        Category::create(['title'=>'Schools','image'=>asset('assets/images/Categories/svgexport-7 (9).png')]);
        // dummy data
        Place::create([
            'category_id' => 1,

            'name' => 'testNameOfPlace',
            'image' => fake()->imageUrl(),
            'feature' => 'testingFeature',
            'Municipality' => 'testingMunicipality',
            'phones' => fake()->phoneNumber(),
            'emails' => fake()->email(),
            'Website' => fake()->url(),
            'street' => fake()->streetAddress(),
            'full_address' => fake()->address(),
            'google_map_url' => 'url of GoogleMap',
            'latitude' => '53.957964',
            'longitude' => fake()->longitude(),
            'available' => fake()->boolean(),
            'PlaceFeatures' => json_encode(['test','test'])
        ]);
        Place::create([
            'category_id' => 1,

            'name' => 'testNameOfPlace2',
            'image' => fake()->imageUrl(),
            'feature' => 'testingFeature2',
            'Municipality' => 'testingMunicipality2',
            'phones' => fake()->phoneNumber(),
            'emails' => fake()->email(),
            'Website' => fake()->url(),
            'street' => fake()->streetAddress(),
            'full_address' => fake()->address(),
            'google_map_url' => 'url of GoogleMap2',
            'latitude' => '53.957964',
            'longitude' => '-1.0854995',
            'available' => fake()->boolean(),
            'PlaceFeatures' => json_encode(['test','test'])
        ]);

        Review::create([
            'comment'=>'testComment',
            'place_id'=>1,
            'user_id'=>1
        ]);

        Rating::create([
            'place_id' => 1,
            'review_id' => 1,
            'rate' => 2,
        ]);
        Rating::create([
            'place_id' => 1,
            'rate' => 5,
        ]);
        // //////////
    }
}
