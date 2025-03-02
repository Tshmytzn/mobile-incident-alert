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
        'responder_id',
        'responder_name',
        'responder_type',
        'status',
        'reported_at'
    ];
}
