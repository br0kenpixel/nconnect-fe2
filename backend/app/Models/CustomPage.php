<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{
    use HasFactory;
    public const DISPLAY_NONE = "none";
    public const DISPLAY_NAV = "navigation";
    public const DISPLAY_BOTTOM = "bottom";

    protected $table = "custom_pages";
    protected $fillable = ["name", "content", "display"];
}
