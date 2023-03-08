<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('category_id');
            // $table->integer('CategoryName');
            // $table->integer('Likes_id')->nullable();
            $table->integer('Reviews_id')->nullable();

            // $table->string('title');
            // $table->string('image');
            // $table->string('address')->nullable();
            // $table->boolean('available');

            // $table->boolean('eat_in_place')->nullable();
            // $table->boolean('delivery')->nullable();
            // $table->boolean('fast_food')->nullable();

            // details
            $table->string('name');
            $table->string('image');
            $table->string('feature');
            $table->string('Municipality');
            $table->string('phones')->nullable();
            $table->string('emails')->nullable();
            $table->string('Website')->nullable();
            // $table->string('full_address');
            $table->string('street')->nullable();
            $table->string('full_address')->nullable();
            // full address
            // $table->string('municipality');
            // $table->string('plus_code');
            // $table->integer('average_rating');
            $table->string('google_map_url')->nullable();
            // $table->string('google_knowledge');
            // $table->string('kgmid');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            // can do
            $table->boolean('available')->default(false);
            $table->string('PlaceFeatures')->nullable();

            // $table->boolean('eat_in_place')->default(false);
            // $table->boolean('delivery')->default(false);
            // $table->boolean('fast_food')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
};
