<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tweet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tweet::class;
    public function definition(): array
    {
        return [
            //
            'user_id'=>1,
            'content'=>$this->faker->realText(100),
            'created_at'=>Carbon::now()->yesterday(),
        ];
    }
}
