<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerQualifacations extends Model
{
    use HasFactory;
    protected $table = 'career_qualifications';
    protected $fillable = ['career_id', 'qualification_id'];
}
