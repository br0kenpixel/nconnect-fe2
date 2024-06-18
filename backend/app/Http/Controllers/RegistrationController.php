<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Registration;
use App\Models\Schedule;
use App\Models\Speaker;
use App\Models\Stage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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

    public function create(Request $request): Response
    {
        $validated = Validator::make($request->all(), [
            "email" => "required|email|max:96",
            "name" => "required|max:64",
            "selection" => "required|array"
        ], $request->all());

        if ($validated->fails()) {
            return response("Invalid body structure", 400);
        }

        foreach ($request->selection as $schedule) {
            $entry_schedule = Schedule::find($schedule);

            if ($entry_schedule === null) {
                return response("Invalid schedule", 400);
            }

            if ($entry_schedule->speaker === null) {
                return response("Schedule (" . $schedule . ") is not a presentation", 400);
            }
        }

        $attendee = Attendee::create([
            "email" => $request->email,
            "name" => $request->name
        ]);

        $this->write_registration($request, $attendee);

        return response(status: 201);
    }

    public function get(int $id): JsonResponse
    {
        $attendee = Attendee::find($id);
        if ($attendee === null) {
            return response(status: 400)->json(["error" => "Invalid attendee"]);
        }

        $registrations = Registration::whereColumn("attendee", "=", $id)->get(["schedule"])->all();

        $result = [
            "email" => $attendee->email,
            "name" => $attendee->name,
            "selection" => array_map(fn($value): int => $value->schedule, $registrations),
        ];

        return response()->json($result);
    }

    public function update(int $id, Request $request): Response
    {
        $attendee = Attendee::find($id);
        if ($attendee === null) {
            return response(status: 400)->json(["error" => "Invalid attendee"]);
        }

        $validated = Validator::make($request->all(), [
            "email" => "required|email|max:96",
            "name" => "required|max:64",
            "selection" => "required|array"
        ], $request->all());

        if ($validated->fails()) {
            return response("Invalid body structure", 400);
        }

        Registration::whereColumn("attendee", "=", $id)->delete();

        $this->write_registration($request, $attendee);

        return response(status: 201);
    }

    public function delete(int $id): Response
    {
        $attendee = Attendee::find($id);
        if ($attendee === null) {
            return response("Invalid attendee", 400);
        }

        Registration::whereColumn("attendee", "=", $id)->delete();
        $attendee->delete();

        return response(status: 201);
    }

    private function write_registration(Request $request, Attendee $attendee)
    {
        foreach ($request->selection as $schedule) {
            Registration::create([
                "attendee" => $attendee->id,
                "schedule" => $schedule,
            ]);
        }
    }
}
