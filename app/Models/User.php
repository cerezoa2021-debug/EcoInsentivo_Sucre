<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = [
        'nombre', 
        'apellido', 
        'email', 
        'password', 
        'telefono', 
        'estado'
    ];
    protected $hidden = [
        'password', 
        'remember_token'
    ];
 
    public function billetera()
    {
        return $this->hasOne(Billetera::class);
    }
 
    public function registrosReciclaje()
    {
        return $this->hasMany(Registro_reciclaje::class);
    }
 
    public function canjes()
    {
        return $this->hasMany(Canje::class);
    }
    //perfil 
    public function adminlte_profile_url()
    {
        return route('profile.edit');
    }
}
