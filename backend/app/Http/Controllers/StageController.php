<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\JsonResponse;

class StageController extends Controller
{
    public function all(): JsonResponse
    {
        $sponsors = Stage::all(["id", "conference", "name"]);

        return response()->json($sponsors);
    }
}
