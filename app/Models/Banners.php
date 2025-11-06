<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'title',
        'context',
        'link',
        'banner_image_id',
    ];

    // 🖼 Each banner belongs to an image
    public function image()
    {
        return $this->belongsTo(Images::class, 'banner_image_id');
    }
}
