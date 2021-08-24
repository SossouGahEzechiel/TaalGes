<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    // Un service peut enrôler plusieurs salariés
    public function salaries()
    {
        return $this->hasMany(Salarie::class);
    }
}
