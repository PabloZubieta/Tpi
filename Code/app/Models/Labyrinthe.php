<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labyrinthe extends Model
{
    use HasFactory;


    protected $fillable = [
        'labyrinthe_code',
        'length',
        'height',
        'users_id'
    ];
}
