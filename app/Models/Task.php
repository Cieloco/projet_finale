<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'description',
        'status',
        'confirmed_at',
        'utilisateur_id',
        'service_id'
    ];

    protected $dates = ['created_at', 'updated_at', 'validated_at'];

    public function utilisateur() {
        return $this->belongsTo(Utilisateur::class);
    }
    public function difficulties() {
        return $this->hasMany(Difficulty::class);
    }
    public function resources() {
        return $this->belongsToMany(Resource::class)->withTimestamps();
    }
    public function service() {
        return $this->belongsTo(Service::class);
    }
    
}
