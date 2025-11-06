<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Careers extends Model
{
    use HasFactory;

    protected $table = 'careers';
    protected $fillable = [
        'career_image_id',
        'job_type',
        'career_name',
        'experience',
        'vacancy',
        'overview',
    ];

    // Career Responsibilities
    public function responsibilities()
    {
        return $this->belongsToMany(Responsibilities::class, 'career_responsibilities', 'career_id', 'responsibility_id');
    }

    // Career Qualifications
    public function qualifications()
    {
        return $this->belongsToMany(Qualifications::class, 'career_qualifications', 'career_id', 'qualification_id');
    }

    public function image()
    {
        return $this->belongsTo(Images::class, 'career_image_id');
    }

    public function getMonthsAgoAttribute()
    {
        return Carbon::parse($this->created_at)->diffInMonths(Carbon::now());
    }
}
