<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'CIN',
        'birth',
        'name',
        'prenom',
        'email',
        'phone_number',
        'role',
        'service_id',
        'password',
        'email_verified_at',
    ];

    protected $dates = ['created_at', 'updated_at', 'email_verified_at']; 
    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class)->delete();
    }

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

