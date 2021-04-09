<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'division',
        'brand',
        'material',
        'description',
        'description_es',
        'amount',
        'unit',
        'per',
        'uom',
        'min_package',
        'abc',
    ];
}
