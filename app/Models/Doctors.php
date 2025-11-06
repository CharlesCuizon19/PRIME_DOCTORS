<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'clinic_room_number',
        'clinic_hours',
        'phone_num',
        'telephone_num',
        'doctor_image_id',
    ];

    // Relationships
    public function specializations()
    {
        return $this->belongsToMany(Specializations::class, 'doctor_specializations', 'doctor_id', 'specialization_id')->withPivot('type');
    }

    public function languages()
    {
        return $this->belongsToMany(Languages::class, 'doctor_languages', 'doctor_id', 'language_id');
    }

    public function image()
    {
        return $this->belongsTo(Images::class, 'doctor_image_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
