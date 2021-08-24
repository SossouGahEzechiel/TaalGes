<?php

namespace Database\Factories;

use App\Models\Demande;
use App\Models\Salarie;
use App\Models\TypeDemande;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Demande::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dateDem'=>$this->faker->date(),
            'dateDeb'=>$this->faker->date(),
            'nbrJours'=>$this->faker->numberBetween(0,30),
            'salarie_id'=>$this->faker->randomElement(Salarie::pluck('id')->toArray()),
            'type_demande_id'=>$this->faker->randomElement(TypeDemande::pluck('id')->toArray()),
        ];
    }
}
