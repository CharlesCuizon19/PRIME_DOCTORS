<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    use HasFactory;

    protected $fillable = [
        'language',
    ];

    // Relationships
    public function doctors()
    {
        return $this->belongsToMany(Doctors::class, 'doctor_languages', 'language_id', 'doctor_id');
    }
}
