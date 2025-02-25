<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Responder extends Model
{
    use HasFactory;

    protected $table = 'responder';

    protected $fillable = [
        'username',
        'name',
        'password',
        'type',
        'status'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
