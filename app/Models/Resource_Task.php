<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource_Task extends Model
{
    use HasFactory;
    
    protected $dates = ['created_at', 'updated_at'];
}
