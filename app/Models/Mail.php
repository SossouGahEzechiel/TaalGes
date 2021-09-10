<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at','updated_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
