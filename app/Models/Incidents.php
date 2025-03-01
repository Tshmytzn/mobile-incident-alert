<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidents extends Model
{
    use HasFactory;
    protected $table = 'incidents';
    protected $fillable = [
        'user_id',
        'type',
        'latitude',
        'longitude',
        'description',
        'status',
        'reported_at'
    ];
}
