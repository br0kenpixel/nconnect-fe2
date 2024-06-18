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
    protected $fillable = ["title", "description", "start", "end", "speaker", "stage", "seats"];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class, "stage")->with(["conference:id,year,date"]);
    }

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class, "speaker");
    }

    public function seats_available(): bool
    {
        $registrations = Registration::whereColumn("schedule", "=", $this->id)->count();

        return $registrations < $this->seats;
    }

    public function count_registrations(): int
    {
        return Registration::whereColumn("schedule", "=", $this->id)->count();
    }

    public function conflicts_with(Schedule $other): bool
    {
        $thisStart = strtotime($this->start);
        $thisEnd = strtotime($this->end);

        $otherStart = strtotime($other->start);
        $otherEnd = strtotime($other->end);

        return $thisStart < $otherEnd && $thisEnd > $otherStart;
    }
}
