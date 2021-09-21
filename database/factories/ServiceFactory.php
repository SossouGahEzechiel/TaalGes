<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lib'=>$this->faker->sentence(2),
            'directeur_id'=>$this->faker->randomElement(User::whereFonction('admin')->get()->pluck('id')->toArray())
        ];
    }
}
