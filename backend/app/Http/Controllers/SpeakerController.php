<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\JsonResponse;

class SpeakerController extends Controller
{
    public function all(): JsonResponse
    {
        $speakers = Speaker::all(["id", "name", "company", "description", "image", "headliner"]);

        return response()->json($speakers);
    }
}
