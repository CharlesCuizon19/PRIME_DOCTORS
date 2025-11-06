<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorLanguages extends Model
{
    use HasFactory;

    protected $table = 'doctor_languages';
    protected $fillable = [
        'doctor_id',
        'language_id',
    ];

    // 👇 Define relationships
    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'doctor_id');
    }

    public function language()
    {
        return $this->belongsTo(Languages::class, 'language_id');
    }
}
