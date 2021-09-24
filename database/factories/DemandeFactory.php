<?php

namespace Database\Factories;

use App\Models\Demande;
use App\Models\Salarie;
use App\Models\TypeDemande;
use App\Models\User;
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
        // if(!function_exists('v_at')){

        //     function v_at($decision)
        //     {
        //         if ($decision !=null){
        //             return now();
        //         }
        //         return null;  
        //     }
        // }
        // if(!function_exists('v_by')){
        //     function v_by($decision)
        //     {
        //         if ($decision!=null){
        //             $array = User::whereFonction('admin')->pluck('id')->toArray();
        //             return $array[array_rand($array)];
        //         }
        //         return null;  
        //     }
        // }
        return [
            'typeDem'=>$this->faker->randomElement(['congé','permission']),
            'dateDem'=>$this->faker->date(),
            'dateDeb'=>$this->faker->date(),
            'duree'=>$this->faker->numberBetween(1,3),
            'objet'=>$this->faker->sentence(3,true),
            'decision'=> $decision = $this->faker->randomElement(['Accordé','Refusé',null]),
            "v_by" => $this->faker->randomElement(User::whereFonction('admin')->pluck('id')->toArray()),
            "v_at" => $this->faker->date(),
            'user_id'=>$this->faker->randomElement(User::pluck('id')->toArray()),
            // dd($decision),
        ];
    }
    
    
}
