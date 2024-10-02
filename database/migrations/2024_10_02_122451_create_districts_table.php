<?php

use App\Models\District;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('region_id');
            $table->string('key');
            $table->json('name');
            $table->geometry(column: 'boundaries', subtype: 'polygon');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        $districts = json_decode(Storage::disk("local")->get("districts.json"));

        foreach ($districts as $district) {

            $boundaries = [];
        
            foreach($district->boundaries[0] as $key => $boundary) {
                $boundaries[] = new Point($boundary[0], $boundary[1]);
            }

            $boundariesLineString = new LineString($boundaries);
            $boundariesPolygon = new Polygon([$boundariesLineString]);

            District::create([
                'district_id' => $district->district_id,
                'city_id' => $district->city_id,
                'region_id' => $district->region_id,
                'key' => $district->name_en,
                'name' => ['ar' => $district->name_ar, 'en' => $district->name_en],
                'boundaries' => $boundariesPolygon,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
