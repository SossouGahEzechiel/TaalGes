<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demand extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "demandes";
    
    protected $dates = ["dateDem","dateDeb","v_at"];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(TypeDemande::class);
    }

    public function conge()
    {
        return $this->hasOne(Leave::class);
    }

    public function permission()
    {
        return $this->hasOne(Permission::class);
    }

    public function v_by()
    {
        return User::whereId($this->v_by)->first();
    }

}
