<?php

namespace Tests\Unit\Http\Requests;


use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class PropertyRequestTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.properties.';

    /**
     * A basic unit test example.
     *
     * @test
     * @throws \Throwable
     * @return void
     */
    public function type_is_required()
    {
//        $this->withoutExceptionHandling();

        $validatedField = 'type';
        $brokenRule = null;

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);

        // Update assertion
        $existingProperty = Property::factory()->create();
        $newProperty = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->putJson(
            route($this->routePrefix . 'update', $existingProperty),
            $newProperty->toArray()
        )->assertJsonValidationErrors($validatedField);

    }

    /**
     * @test
     * @return void
     */
    public function title_is_required(){
        $validatedField = 'title';
        $brokenRule = null;

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);

        // Update assertion
        $existingProperty = Property::factory()->create();
        $newProperty = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->putJson(
            route($this->routePrefix . 'update', $existingProperty),
            $newProperty->toArray()
        )->assertJsonValidationErrors($validatedField);
    }




    /**
     * @test
     */
    public function type_must_not_exceed_20_characters()
    {
        $validatedField = 'type';
        $brokenRule = Str::random(21);

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     */
    public function title_must_not_exceed_255_characters(){
        $validatedField = 'title';
        $brokenRule = Str::random(256);

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function price_is_required()
    {
        $validatedField = 'price';
        $brokenRule = null;

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);
        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function price_must_be_an_integer()
    {
        $validatedField = 'price';
        $brokenRule = 'not-integer';

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

}
