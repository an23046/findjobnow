<?php

namespace Database\Factories;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use function Laravel\Prompts\text;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobOffer>
 */
class JobOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
    {
        $salary = $this->faker->numberBetween(800, 3000);
        $companyName = $this->faker->company; 
        $jobTitle = $this->faker->jobTitle;

        return [
            'title' => $jobTitle,
            'description' => $this->faker->text(200),
            'company_name'=> $companyName,
            'salary' => $salary
        ];
    }
}
