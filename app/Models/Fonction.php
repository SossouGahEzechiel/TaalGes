<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    // Plusieurs salaliers peuvent occuper la même fonction
    public function salaries()
    {
        return $this->hasMany(Salarie::class);
    }
}
