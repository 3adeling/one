<?php

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use MatanYadaev\EloquentSpatial\Objects\Point;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('region_id');
            $table->string('key');
            $table->json('name');
            $table->geometry(column: 'center', subtype: 'point')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        $cities = json_decode(Storage::disk("local")->get("cities.json"));

        foreach ($cities as $city) {
            City::create([
                'city_id' => $city->city_id,
                'region_id' => $city->region_id,
                'key' => $city->name_en,
                'name' => ['ar' => $city->name_ar, 'en' => $city->name_en],
                'center' => new Point($city->center[0], $city->center[1]),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
