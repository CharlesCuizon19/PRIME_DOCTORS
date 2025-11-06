<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InclusionsServices extends Model
{
    use HasFactory;

    protected $table = 'inclusion_services';

    protected $fillable = [
        'inclusion_id',
        'service_id',
    ];
}
