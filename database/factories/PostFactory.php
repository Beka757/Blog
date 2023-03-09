<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->realText(),
            'body' => $this->faker->realText(1000),
            'picture' => $this->getImage(rand(1, 10))
        ];
    }

    /**
     * @param $image_number
     * @return string
     */
    private function getImage($image_number = 1): string
    {
        $path = storage_path() . "/seed_pictures/posts/" . $image_number . ".jpg";
        $image_name = md5($path) . '.jpg';
        $resize = Image::make($path)->fit(500)->encode('jpg');
        Storage::disk('public')->put('pictures/' . $image_name, $resize->__toString());
        return 'pictures/' . $image_name;
    }
}
