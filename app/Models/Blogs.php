<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'slug',
        'title',
        'context',
        'blog_date',
        'category_id',
        'blog_image_id',
        'uploaded_by_id',
    ];

    protected $casts = [
        'blog_date' => 'datetime',
    ];

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by_id');
    }

    public function image()
    {
        return $this->belongsTo(Images::class, 'blog_image_id');
    }

    // Blog.php
    public function category()
    {
        return $this->belongsTo(BlogCategories::class, 'category_id');
    }
}
