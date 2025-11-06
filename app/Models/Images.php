<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'uploaded_by_id',
        'alt_text',
    ];

    // 🔗 Each image belongs to a file
    public function file()
    {
        return $this->belongsTo(Files::class, 'file_id');
    }

    // 🧍 Example if you have a user system
    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by_id');
    }

    // 🏞 An image can belong to many banners (if reused)
    public function banners()
    {
        return $this->hasMany(Banners::class, 'banner_image_id');
    }
    public function services()
    {
        return $this->hasMany(Services::class, 'service_image_id');
    }

    public function careers()
    {
        return $this->hasMany(Careers::class, 'career_image_id');
    }
    public function doctors()
    {
        return $this->hasMany(Services::class, 'doctor_image_id');
    }
    public function blogs()
    {
        return $this->hasMany(Blogs::class, 'blog_image_id');
    }
}
