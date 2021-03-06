<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom'           =>      $this->faker->firstName(),
            'prenom'        =>      $this->faker->lastName(),
            'adresse'       =>      $this->faker->address(),
            'tel'           =>      $this->faker->phoneNumber(),
            'email'         =>      $this->faker->email(),
            'password'      =>      Hash::make($this->faker->password()),
            'sexe'          =>      $this->faker->randomElement(['M','F']),
            'dateEmb'       =>      $this->faker->dateTime(),
            'natCont'       =>      $this->faker->randomElement(['CDD','CDI']),
            'dureCont'      =>      $this->faker->numberBetween(0,36),
            'fonction'      =>      $this->faker->randomElement(['admin','user']),
            'service_id'    =>      $this->faker->randomElement(Service::pluck(('id'))->toArray()),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
