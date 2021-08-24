<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDemande extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    // Un type de demande peut concerner plusieurs demandes
    public function demande()
    {
        return $this->hasMany(Demande::class);
    }
}
