<?php

namespace Database\Factories;

use App\Services\UrlService;
use http\Url;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShortLink>
 */
class ShortLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $service = new UrlService();

        $link = $this->faker->url();
        $title = $service->getTitleFromUrl($link);

        return [
            'code' => Str::random(6),
            'title' => $title,
            'link' => $link
        ];
    }
}
