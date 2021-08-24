<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Civilite extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    // La civilité peut concerner plusieurs salariés
    public function salaries()
    {
        return $this->hasMany(salarie::class);
    }
}
