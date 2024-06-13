<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $dates = ['created_at', 'updated_at'];

    public function utilisateurs() {
        return $this->hasMany(Utilisateur::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }
    
}
