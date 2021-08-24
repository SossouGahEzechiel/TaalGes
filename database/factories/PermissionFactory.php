<?php

namespace Database\Factories;

use App\Models\Demande;
use App\Models\Permission;
use App\Models\TypePermission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'objet'=>$this->faker->text(100),
            'decision'=>$this->faker->randomElement(['Accordée','Refusée']),
            'type_permission_id'=>$this->faker->randomElement(TypePermission::pluck('id')->toArray()),
            'demande_id'=>$this->faker->randomElement(Demande::pluck('id')->toArray())
        ];
    }
}
