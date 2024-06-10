<?php

namespace App\Models;

use App\Models\Stage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    protected $table = "schedules";
    protected $fillable = ["title", "description", "start", "end", "speaker", "stage"];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class, "stage")->with(["conference:id,year,date"]);
    }

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class, "speaker");
    }
}
