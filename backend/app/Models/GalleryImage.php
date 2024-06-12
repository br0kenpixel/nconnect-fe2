<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryImage extends Model
{
    use HasFactory;

    protected $table = "gallery_images";
    protected $fillable = ["conference", "image"];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class, "conference");
    }
}
