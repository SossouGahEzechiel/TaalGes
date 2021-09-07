<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    public $timestamps = false;
    protected $guarded = [];

    protected $dates = ['dateEmb'];

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
