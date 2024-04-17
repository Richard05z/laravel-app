<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyUser extends Model
{
    use HasFactory;

    protected $table = 'user';

    // Campos que pueden ser alterados
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country'
    ];
}
