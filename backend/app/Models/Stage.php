<?php

namespace App\Models;

use App\Models\Conference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stage extends Model
{
    use HasFactory;

    protected $table = "stages";
    protected $fillable = ["conference", "name"];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class, "conference");
    }
}
