<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specializations extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialization_name',
    ];

    // Relationships
    public function doctors()
    {
        return $this->belongsToMany(Doctors::class, 'doctor_specializations', 'specialization_id', 'doctor_id')->withPivot('type');
    }
}
