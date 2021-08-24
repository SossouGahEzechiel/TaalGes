<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePermission extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    // Un type de permission peut concerner plusieurs permissions
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
