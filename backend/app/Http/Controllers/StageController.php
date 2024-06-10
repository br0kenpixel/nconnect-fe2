<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\JsonResponse;

class StageController extends Controller
{
    public function all(): JsonResponse
    {
        $stages = Stage::with("conference:id,year,date")->get(["id", "conference", "name"])->all();

        return response()->json($stages);
    }
}
