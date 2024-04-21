<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    // Campos que pueden ser alterados
    protected $fillable = [
        'from',
        'to',
        'amount',
        'currency'
    ];
}
