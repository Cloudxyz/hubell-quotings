<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public $timestamps = true;
    
    protected $fillable = [
        'lastname',
        'country',
        'state',
        'city',
        'street',
        'zip',
        'phone',
        'client_number'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
