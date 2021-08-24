<?php

namespace Database\Factories;

use App\Models\Conge;
use App\Models\Demande;
use Illuminate\Database\Eloquent\Factories\Factory;

class CongeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Conge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'etatConge'=>$this->faker->randomElement(['accordé','refusé']),
            'demande_id'=>$this->faker->randomElement(Demande::pluck('id')->toArray())
        ];
    }
}
