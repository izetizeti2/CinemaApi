<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

   
    protected $hidden = [
        'password',
    ];

   
    protected $casts = [
        'password' => 'hashed',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'favorites'); // Përdorim belongsToMany për marrëdhënien shumë për shumë
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
