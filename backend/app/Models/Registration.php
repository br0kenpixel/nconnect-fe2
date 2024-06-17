<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;

    protected $table = "registrations";
    protected $fillable = ["attendee", "schedule"];

    public function attendee(): BelongsTo
    {
        return $this->belongsTo(Attendee::class, "attendee");
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, "schedule");
    }
}
