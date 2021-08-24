<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salarie extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    public $dates = ['dateEmb'];

    // Un salarier ne peut remplir qu'une seule fonction
    public function fonction()
    {
        return $this->belongsTo(Fonction::class);
    }
    // Un salarier ne peut posseder qu'une seule civilité
    public function civilite()
    {
        return $this->belongsTo(Civilite::class);
    }
    // Un salarier ne peut appartenir qu'à un seul service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    // Un salarier peut faire plusieurs demandes
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
