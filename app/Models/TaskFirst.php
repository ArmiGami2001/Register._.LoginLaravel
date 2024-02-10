<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskFirst extends Model
{
    use HasFactory;

    protected $table = 'task_firsts';

    protected $filleble = ['id', 'name', 'email', 'password'];
}
