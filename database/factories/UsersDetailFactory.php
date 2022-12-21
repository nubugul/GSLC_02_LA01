<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UsersDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersDetailFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'alamat' => $this->faker->address,
            'jenis_kelamin' => 'L'
        ];
    }
}
