<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefits extends Model
{
    use HasFactory;

    protected $table = 'benefits';

    protected $fillable = [
        'benefit_name',
    ];

    // ✅ Many-to-many with Services
    public function services()
    {
        return $this->belongsToMany(Services::class, 'benefit_services', 'benefit_id', 'service_id');
    }
}
