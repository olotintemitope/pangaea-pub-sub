<?php

namespace Database\Factories;

use App\Models\Subscriber;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscriber::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'topic_id' => Topic::factory(),
            'url' => $this->faker->url,
        ];
    }
}
