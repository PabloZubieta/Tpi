<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_does_labyrinthe extends Model
{
    use HasFactory;

    protected $fillable = [
        'labyrinthes_id',
        'users_id'
    ];
}
