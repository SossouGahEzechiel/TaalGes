<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;
    protected $guarded = [];

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    protected $dates = ['dateEmb'];

    public function demandes()
    {
        return $this->hasMany(Demand::class);
    }
    public function mails()
    {
        return $this->HasMany(Mail::class);
    }

    public function isBoss()
    {
        return (Service::whereDirecteur_id($this->id)->first()) ? true : false;
    }
    
}
