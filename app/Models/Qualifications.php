<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualifications extends Model
{
    use HasFactory;

    protected $table = 'qualifications';
    protected $fillable = ['qualification'];

    // Careers related
    public function careers()
    {
        return $this->belongsToMany( Careers::class, 'career_qualifications','qualification_id','career_id');
    }
}
