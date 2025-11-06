<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsibilities extends Model
{
    use HasFactory;

    protected $table = 'responsibilities';
    protected $fillable = ['responsibility'];

    // Careers related
    public function careers()
    {
        return $this->belongsToMany(Careers::class,'career_responsibilities','responsibility_id','career_id');
    }
}
