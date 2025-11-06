<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
    ];

    // 🖼 One file can belong to one image
    public function image()
    {
        return $this->hasOne(Images::class, 'file_id');
    }
}
