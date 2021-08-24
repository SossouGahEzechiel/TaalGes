<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    protected $dates = ['dateDeb','dateDem'];

    // Perme de définir une relation polymorphique avec le modéle (et donc la table) Demande
    public function demandeable()
    {
        return $this->morphTo();
    }

    // La demande ne peut être émise que par un seul salarié
    public function salarie()
    {
        return $this->belongsTo(salarie::class);
    }

    // public function conge()
    // {
    //     return $this->belongsTo(Conge::class);
    // }
    // public function permission()
    // {
    //     return $this->belongsTo(Permission::class);
    // }
}
