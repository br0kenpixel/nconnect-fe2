<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Schedule;
use App\Models\Stage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
                    ->get(["id", "title", "description", "start", "end", "speaker"])
                    ->all();
                $stage["schedule"] = $schedule;
            }

            $conference["stages"] = $stages;
        }

        return response()->json($conferences);
    }

    public function create(Request $request): Response
    {
        if (!$this->validate_request($request)) {
            return response(status: 400);
        }

        Schedule::create($request->all());

        return response(status: 201);
    }

    public function delete(int $id): Response
    {
        Schedule::find($id)->deleteOrFail();
        return response(status: 204);
    }

    public function update(int $id, Request $request): Response
    {
        if (!$this->validate_request($request)) {
            return response(status: 400);
        }

        $keys = $request->all();
        if ($keys["speaker"] === null) {
            unset($keys["speaker"]);
        }

        Schedule::find($id)->updateOrFail($keys);

        return response(status: 204);
    }

    private function validate_request(Request $request): bool
    {
        $validated = Validator::make($request->all(), [
            "title" => "required|max:64",
            "description" => "required",
            "start" => "required|date_format:H:i",
            "end" => "required|date_format:H:i|after:start",
            "speaker" => "nullable|integer",
            "stage" => "required|integer"
        ], $request->all());

        return $validated->passes();
    }
}
