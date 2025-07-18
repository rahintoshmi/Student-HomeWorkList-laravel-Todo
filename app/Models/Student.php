<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'option', 'topic', 'status'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    
}
