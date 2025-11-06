<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerResponsibilities extends Model
{
    use HasFactory;

    protected $table = 'career_responsibilities';
    protected $fillable = ['career_id', 'responsibility_id'];
}
