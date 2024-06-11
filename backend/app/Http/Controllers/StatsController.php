<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Stage;
use Illuminate\Http\JsonResponse;

class StatsController extends Controller
{
    public function basic(): JsonResponse
    {
        $conferences = Conference::count();
        $attendees = 0;
        $stages = Stage::count();
        $next_conference = $this->next_conference();
        $last_registration = null;

        return response()->json([
            "conferences" => $conferences,
            "attendees" => $attendees,
            "stages" => $stages,
            "next_conference" => $next_conference,
            "last_registration" => $last_registration,
        ]);
    }

    public function next_conference(): Conference|null
    {
        return null;
    }
}
