<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
      /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nama' => $this->faker->userName,
            'kode' =>  substr($this->faker->randomDigit, 0, 6),
            'email' => $this->faker->email,
            'no_hp' => substr($this->faker->phoneNumber, 0, 12),
            'alamat' => $this->faker->address,
            'asal' => $this->faker->country,
            'npwp' => $this->faker->randomDigit
        ];
    }
}
