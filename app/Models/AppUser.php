<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class AppUser extends Model
{
    use HasFactory;

    protected $table = 'app_user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'role',
        'address',
        'emergency_contact_name',
        'emergency_contact_number',
        ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
