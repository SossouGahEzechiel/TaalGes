<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];


    /**
     * Get all of the salaries for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salaries(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function boss()
    {
        return User::whereId($this->directeur_id)->first();
    }
}
