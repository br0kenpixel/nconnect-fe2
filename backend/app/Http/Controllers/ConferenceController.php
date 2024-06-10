<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\JsonResponse;

class ConferenceController extends Controller
{
    public function all(): JsonResponse
    {
        $conferences = Conference::all(["id", "year", "date"]);

        return response()->json($conferences);
    }
}
