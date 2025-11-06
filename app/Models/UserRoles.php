<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
