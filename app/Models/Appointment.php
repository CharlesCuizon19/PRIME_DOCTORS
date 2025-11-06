<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'full_name',
        'phone_number',
        'appointment_date',
    ];

    /**
     * Relationship: Each appointment belongs to one doctor.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctors::class);
    }
}
