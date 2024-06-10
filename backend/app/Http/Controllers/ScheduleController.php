<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Schedule;
use App\Models\Stage;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    public function all(): JsonResponse
    {
        $conferences = Conference::get(["id", "year", "date"])->all();

        foreach ($conferences as $conference) {
            $stages = Stage::whereColumn("conference", "=", $conference->id)->get(["id", "name"])->all();

            foreach ($stages as $stage) {
                $schedule = Schedule::where("stage", "=", $stage->id)
                    ->with("speaker:id,name,company,image,headliner")
                    ->get(["title", "description", "start", "end", "speaker"])
                    ->all();
                $stage["schedule"] = $schedule;
                unset($stage["id"]);
            }

            $conference["stages"] = $stages;
            unset($conference["id"]);
        }

        return response()->json($conferences);
    }
}
