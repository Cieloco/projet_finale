<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type'
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function tasks() {
        return $this->belongsToMany(Task::class)->withTimestamps();
    }
    
}
