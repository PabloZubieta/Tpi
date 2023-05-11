<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labyrinthe extends Model
{
    use HasFactory;

    protected $table = 'labyrinthe';

    protected $fillable = [
        'labyrinthe_code',
        'lenght',
        'height',
        'users_id'
    ];
}
