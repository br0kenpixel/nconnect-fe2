<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Stage;
use DateTime;
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

    public static function next_conference(): Conference|null
    {
        $candidate = Conference::whereColumn("year", "=", date("Y"))->first(["id", "year", "date"]);

        if ($candidate === null) {
            return null;
        }

        $date = new DateTime($candidate->date);
        $now = new DateTime();

        if ($date < $now) {
            return null;
        }

        return $candidate;
    }
}
