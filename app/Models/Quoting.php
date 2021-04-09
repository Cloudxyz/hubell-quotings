<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Quoting extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'client',
        'contact',
        'address',
        'zone',
        'project',
        'duration',
        'seller',
        'products',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
