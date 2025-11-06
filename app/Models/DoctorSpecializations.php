<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecializations extends Model
{
    use HasFactory;

    protected $table = 'doctor_specializations';

    protected $fillable = [
        'doctor_id',
        'specialization_id',
        'type',
    ];
    protected $attributes = [
        'type' => 'Secondary',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'doctor_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specializations::class, 'specialization_id');
    }
}
