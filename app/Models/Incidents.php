<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidents extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'latitude',
        'longitude',
        'description',
        'status',
        'reported_at'
    ];

    protected $casts = [
        'reported_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(AppUser::class, 'user_id');
    }

}
