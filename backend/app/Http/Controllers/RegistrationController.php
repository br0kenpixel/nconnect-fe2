<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Speaker;
use App\Models\Stage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegistrationController extends Controller
{
    public function available(): JsonResponse
    {
        $conference = StatsController::next_conference();

        if ($conference === null) {
            return response()->json([
                "closed" => true,
                "conference" => null
            ]);
        }

        return response()->json([
            "closed" => false,
            "conference" => $conference
        ]);
    }

    public function get_schedule(): JsonResponse
    {
        $conference = StatsController::next_conference();

        if ($conference === null) {
            return response(status: 400)->json();
        }

        $result = [
            "id" => $conference->id,
            "year" => $conference->year,
            "date" => $conference->date,
            "stages" => []
        ];

        $stages = Stage::whereColumn("conference", "=", $conference->id)->get(["id", "name"]);

        foreach ($stages as $stage) {
            $schedule = Schedule::whereColumn("stage", "=", $stage->id)
                ->whereNotNull("speaker")
                ->get(["id", "title", "description", "start", "end", "speaker", "seats"])->all();

            foreach ($schedule as $presentation) {
                $speaker = Speaker::find($presentation->speaker)->first()->get(["id", "name", "company", "description", "image", "headliner"])->first();

                $presentation["speaker"] = $speaker;
            }

            $stage["schedule"] = $schedule;
        }

        $result["stages"] = $stages;
        return response()->json($result);
    }
}
