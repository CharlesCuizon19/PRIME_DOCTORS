<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'title',
        'description',
        'why_it_matters',
        'service_image_id',
        'icon_image_id',
    ];

    public function image()
    {
        return $this->belongsTo(Images::class, 'service_image_id');
    }

    public function icon()
    {
        return $this->belongsTo(Images::class, 'icon_image_id');
    }

    public function benefits()
    {
        return $this->belongsToMany(Benefits::class, 'benefits_services', 'service_id', 'benefit_id');
    }

    public function inclusions()
    {
        return $this->belongsToMany(Inclusions::class, 'inclusions_services', 'service_id', 'inclusion_id');
    }
}
