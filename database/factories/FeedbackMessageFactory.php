<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FeedbackMessage;

class FeedbackMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FeedbackMessage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email = $this->faker->email;
        $txt = $this->faker->realText(rand(100, 500));
        $createdAt = $this->faker->dateTimeBetween('-1 months',
            '-1 days');
        $data = [
            'email' => $email,
            'txt' => $txt,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];

        return $data;
    }
}
