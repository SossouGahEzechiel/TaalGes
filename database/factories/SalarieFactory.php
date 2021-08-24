<?php

namespace Database\Factories;

use App\Models\Civilite;
use App\Models\Fonction;
use App\Models\Salarie;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalarieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Salarie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    
        return [
            'nom' =>$this->faker->name(),
            'prenom' =>$this->faker->lastName(),
            'adresse' =>$this->faker->address(),
            'tel' =>$this->faker->phoneNumber(),
            'dateEmb' =>$this->faker->date(),
            'natCont' =>$this->faker->randomElement(['CDD','CDI']),
            'fonction_id'=>$this->faker->randomElement(Fonction::pluck('id')->toArray()),
            'service_id'=>$this->faker->randomElement(Service::pluck('id')->toArray()),
            'civilite_id'=>$this->faker->randomElement(Civilite::pluck('id')->toArray())                        
        ];
    }
}
