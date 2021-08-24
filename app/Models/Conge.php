<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    // Un congé ne peut concerner qu'une seule demande
    public function demande()
    {
        return $this->morphOne(Demande::class,'demandeable');
    }
}
