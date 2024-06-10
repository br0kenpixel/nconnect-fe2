<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    public function all(): JsonResponse
    {
        $schedule = Schedule::with(["speaker", "stage:id,conference,name"])->get(["id", "title", "description", "start", "end", "speaker", "stage"])->all();

        return response()->json($schedule);
    }
}
