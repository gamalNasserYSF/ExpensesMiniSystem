<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            "entry_date" => $this->faker->date("Y-m-d", $max = 'now'),
            "amount" => $this->faker->randomNumber(),
            "user_id" => User::factory()->create()->id,
            'attachment' => UploadedFile::fake()->image('avatar.jpg'),
        ];
    }

}
