<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inclusions extends Model
{
    use HasFactory;

    protected $table = 'inclusions';

    protected $fillable = [
        'inclusion_name',
    ];

    // ✅ Many-to-many with Services
    public function services()
    {
        return $this->belongsToMany(Services::class, 'inclusion_services', 'inclusion_id', 'service_id');
    }
}
