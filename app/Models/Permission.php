<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    // Une permission n'appartient qu'à un seul type
    public function permissionType()
    {
        return $this->belongsTo(TypePermission::class);
    }

    public function demande()
    {
        return $this->morphOne(Demande::class,'demandeable');
    }
}
