<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenefitsServices extends Model
{
    use HasFactory;

    protected $table = 'benefit_services';

    protected $fillable = [
        'benefit_id',
        'service_id',
    ];
}
