<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Asset;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Room;
use App\Models\User;

class AssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asset::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'serial_number' => $this->faker->word(),
            'name' => $this->faker->name(),
            'image' => $this->faker->imageUrl(),
            'qty' => $this->faker->numberBetween(-10000, 10000),
            'price' => $this->faker->randomFloat(2, 0, 999999.99),
            'brand_id' => Brand::factory(),
            'category_id' => Category::factory(),
            'room_id' => Room::factory(),
            'condition' => $this->faker->randomElement(["new", "used", "damaged"]),
            'purchase_date' => $this->faker->date(),
            'user_id' => User::first()->id,
        ];
    }
}
