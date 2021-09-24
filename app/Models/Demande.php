<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['dateDeb','dateDem','v_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function v_by()
    {
        return User::whereId($this->v_by)->first();
    }
}
