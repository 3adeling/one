<?php

use App\Models\Region;
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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('capital_city_id');
            $table->string('code', 2);
            $table->string('key');
            $table->json('name');
            $table->geometry(column: 'center', subtype: 'point')->nullable();
            $table->geometry(column: 'boundaries', subtype: 'polygon')->nullable();
            $table->integer('population')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        
        $regions = json_decode(Storage::disk("local")->get("regions.json"));
        

        foreach ($regions as $region) {

            $boundaries = [];
        
            foreach($region->boundaries[0] as $key => $boundary) {
                $boundaries[] = new Point($boundary[0], $boundary[1]);
            }

            $boundariesLineString = new LineString($boundaries);
            $boundariesPolygon = new Polygon([$boundariesLineString]);

            Region::create([
                'region_id' => $region->region_id,
                'capital_city_id' => $region->capital_city_id,
                'code' => $region->code,
                'key' => $region->name_en,
                'name' => ['ar' => $region->name_ar, 'en' => $region->name_en],
                'center' => new Point($region->center[0], $region->center[1]),
                'boundaries' => $boundariesPolygon,
                'population' => $region->population,
            ]);
        }
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
