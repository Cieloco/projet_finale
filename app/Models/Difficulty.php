<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'difficulty',
        'solution'
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function task() {
        return $this->belongsTo(Task::class);
    }
}