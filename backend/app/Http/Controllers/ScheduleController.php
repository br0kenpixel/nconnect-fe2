<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Schedule;
use App\Models\Stage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Log;

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
                    ->get(["id", "title", "description", "start", "end", "speaker", "seats"])
                    ->all();

                foreach ($schedule as $presentation) {
                    $presentation["registrations"] = $presentation->count_registrations();
                }

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

        $new_schedule = Schedule::make($request->all());
        $conflict = $this->validate_time_conflict($new_schedule);

        if ($conflict === null || $conflict === true) {
            return response(status: 400);
        }

        $new_schedule->saveOrFail();

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

        $schedule = Schedule::find($id);
        $copy = $schedule->replicate();

        foreach ($request->all() as $key => $value) {
            $copy[$key] = $value;
        }
        $copy["id"] = $schedule->id;

        $conflict = $this->validate_time_conflict($copy);

        if ($conflict === null || $conflict === true) {
            return response(status: 400);
        }

        $schedule->updateOrFail($keys);

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
            "stage" => "required|integer",
            "seats" => "required|integer|gt:0"
        ], $request->all());

        return $validated->passes();
    }

    private function validate_time_conflict(Schedule $new_sched): bool|null
    {
        $stage = Stage::find($new_sched->stage);

        if ($stage === null) {
            return null;
        }

        $stage_schedules = Schedule::whereColumn("stage", "=", $stage->id)->get();

        foreach ($stage_schedules as $schedule) {
            if ($schedule->id === $new_sched->id) {
                continue;
            }

            if ($schedule->conflicts_with($new_sched)) {
                return true;
            }
        }

        return false;
    }
}
